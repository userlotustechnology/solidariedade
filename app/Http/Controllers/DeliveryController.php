<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Participant;
use App\Models\DeliveryRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::withCount(['deliveryRecords'])
            ->orderBy('delivery_date', 'desc')
            ->paginate(15);

        return view('deliveries.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deliveries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'delivery_date' => 'required|date|after_or_equal:today',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled'
        ]);

        $validated['created_by'] = Auth::id();

        Delivery::create($validated);

        return redirect()->route('deliveries.index')
            ->with('success', 'Entrega criada com sucesso!');
    }

    /**
     * Display the specified resource - Lista de participantes para check-in
     */
    public function show(Delivery $delivery)
    {
        // Buscar todos os participantes ativos ordenados alfabeticamente
        $participants = Participant::active()
            ->with(['deliveryRecords' => function($query) use ($delivery) {
                $query->where('delivery_id', $delivery->id);
            }])
            ->orderBy('name')
            ->get();

        // Buscar atestados válidos para todos os participantes
        $validCertificates = DeliveryRecord::where('status', 'excused')
            ->whereNotNull('medical_certificate_expiry')
            ->where('medical_certificate_expiry', '>=', now()->toDateString())
            ->get()
            ->keyBy('participant_id');

        // Criar array com status de cada participante para esta entrega
        $participantStatuses = [];
        foreach ($participants as $participant) {
            $record = $participant->deliveryRecords->first();
            $validCertificate = $validCertificates->get($participant->id);
            
            $participantStatuses[$participant->id] = [
                'participant' => $participant,
                'record' => $record,
                'status' => $this->getParticipantStatus($record),
                'hasValidCertificate' => $validCertificate !== null,
                'validCertificateExpiry' => $validCertificate ? $validCertificate->medical_certificate_expiry : null
            ];
        }

        return view('deliveries.show', compact('delivery', 'participantStatuses'));
    }

    /**
     * Registrar presença/ausência de participante
     */
    public function updateParticipantStatus(Request $request, Delivery $delivery, Participant $participant)
    {
        $request->validate([
            'status' => 'required|in:present,absent,excused',
            'notes' => 'nullable|string|max:500',
            'medical_certificate_expiry' => 'nullable|date|after:today'
        ]);

        $record = DeliveryRecord::firstOrCreate(
            [
                'delivery_id' => $delivery->id,
                'participant_id' => $participant->id
            ],
            [
                'status' => 'present',
                'delivered_at' => now(),
                'delivered_by' => Auth::id(),
                'document_verified' => 'não',
                'observations' => null
            ]
        );

        if ($request->status === 'present') {
            $record->update([
                'status' => 'present',
                'delivered_at' => now(),
                'delivered_by' => Auth::id(),
                'document_verified' => 'sim',
                'observations' => $request->notes,
                'medical_certificate_expiry' => null
            ]);
        } else {
            $updateData = [
                'status' => $request->status,
                'delivered_at' => null,
                'delivered_by' => null,
                'document_verified' => 'não',
                'observations' => $request->notes ?: $this->getStatusMessage($request->status),
                'medical_certificate_expiry' => null
            ];

            // Se for status 'excused' e tiver data de validade do atestado
            if ($request->status === 'excused' && $request->medical_certificate_expiry) {
                $updateData['medical_certificate_expiry'] = $request->medical_certificate_expiry;
            }

            $record->update($updateData);
        }

        // Atualizar contador da entrega
        $delivery->updateDeliveredCount();

        return response()->json([
            'success' => true,
            'message' => $this->getSuccessMessage($request->status, $participant->name)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        return view('deliveries.edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled'
        ]);

        $delivery->update($request->all());

        return redirect()->route('deliveries.index')
            ->with('success', 'Entrega atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        // Verificar se há registros de entrega
        if ($delivery->deliveryRecords()->count() > 0) {
            return redirect()->route('deliveries.index')
                ->with('error', 'Não é possível excluir entrega que já possui registros.');
        }

        $delivery->delete();

        return redirect()->route('deliveries.index')
            ->with('success', 'Entrega excluída com sucesso!');
    }

    /**
     * Determinar status do participante para a entrega
     */
    private function getParticipantStatus($record)
    {
        if (!$record) {
            return 'pending'; // Não registrado ainda
        }

        // Usar a coluna status diretamente se existir
        if (isset($record->status)) {
            return $record->status;
        }

        // Fallback para lógica antiga (caso haja registros sem a coluna status)
        if ($record->delivered_at) {
            return 'present';
        }

        return 'absent';
    }

    /**
     * Mensagem baseada no status
     */
    private function getStatusMessage($status)
    {
        return match($status) {
            'absent' => 'Participante ausente na data da entrega',
            'excused' => 'Ausência justificada com atestado médico',
            default => ''
        };
    }

    /**
     * Mensagem de sucesso baseada no status
     */
    private function getSuccessMessage($status, $participantName)
    {
        return match($status) {
            'present' => "Entrega registrada para {$participantName}",
            'absent' => "Ausência registrada para {$participantName}",
            'excused' => "Ausência justificada registrada para {$participantName}",
            default => "Status atualizado para {$participantName}"
        };
    }
}
