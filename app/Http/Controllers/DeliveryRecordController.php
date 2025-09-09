<?php

namespace App\Http\Controllers;

use App\Models\DeliveryRecord;
use App\Models\Delivery;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryRecordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'delivery_id' => 'required|exists:deliveries,id',
            'participant_id' => 'required|exists:participants,id',
            'document_verified' => 'required|boolean',
            'notes' => 'nullable|string|max:500'
        ]);

        // Verificar se já existe um registro para esta entrega e participante
        $existingRecord = DeliveryRecord::where('delivery_id', $request->delivery_id)
            ->where('participant_id', $request->participant_id)
            ->first();

        if ($existingRecord) {
            return redirect()->back()
                ->with('error', 'Já existe um registro de entrega para este participante nesta data.');
        }

        DeliveryRecord::create([
            'delivery_id' => $request->delivery_id,
            'participant_id' => $request->participant_id,
            'delivered_at' => now(),
            'delivered_by' => Auth::id(),
            'document_verified' => $request->document_verified,
            'notes' => $request->notes
        ]);

        // Atualizar contador da entrega
        $delivery = Delivery::find($request->delivery_id);
        $delivery->updateDeliveredCount();

        $participant = Participant::find($request->participant_id);

        return redirect()->back()
            ->with('success', "Entrega registrada com sucesso para {$participant->name}!");
    }
}
