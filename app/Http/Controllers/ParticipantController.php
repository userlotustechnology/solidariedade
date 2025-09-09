<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Participant::with('registeredBy');

        // Filtro de busca
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filtro de status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where('active', false);
            }
        }

        $participants = $query->orderBy('name')->paginate(15);

        return view('participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('participants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'document_type' => 'required|string|in:CPF,RG,CNH,Passaporte',
            'document_number' => 'required|string|unique:participants,document_number',
            'birth_date' => 'required|date|before:today',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:500',
            'neighborhood' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',
            'zip_code' => 'required|string|max:10',
            'gender' => 'nullable|in:M,F,Other',
            'family_members' => 'required|integer|min:1|max:20',
            'monthly_income' => 'nullable|numeric|min:0',
            'observations' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $participant = Participant::create([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'document_number' => preg_replace('/\D/', '', $request->document_number),
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => strtoupper($request->state),
            'zip_code' => preg_replace('/\D/', '', $request->zip_code),
            'gender' => $request->gender,
            'family_members' => $request->family_members,
            'monthly_income' => $request->monthly_income,
            'observations' => $request->observations,
            'registered_by' => Auth::id(),
            'registered_at' => now()
        ]);

        return redirect()->route('participants.index')
            ->with('success', 'Participante cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        $participant->load(['registeredBy', 'deliveryRecords.delivery', 'deliveryRecords.deliveredBy']);

        // Buscar entregas disponíveis que o participante ainda não recebeu
        $availableDeliveries = \App\Models\Delivery::whereNotIn('id',
            $participant->deliveryRecords()->pluck('delivery_id')
        )->orderBy('delivery_date', 'desc')->get();

        return view('participants.show', compact('participant', 'availableDeliveries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'document_type' => 'required|string|in:CPF,RG,CNH,Passaporte',
            'document_number' => 'required|string|unique:participants,document_number,' . $participant->id,
            'birth_date' => 'required|date|before:today',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:500',
            'neighborhood' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',
            'zip_code' => 'required|string|max:10',
            'gender' => 'nullable|in:M,F,Other',
            'family_members' => 'required|integer|min:1|max:20',
            'monthly_income' => 'nullable|numeric|min:0',
            'observations' => 'nullable|string|max:1000',
            'active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $participant->update([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'document_number' => preg_replace('/\D/', '', $request->document_number),
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => strtoupper($request->state),
            'zip_code' => preg_replace('/\D/', '', $request->zip_code),
            'gender' => $request->gender,
            'family_members' => $request->family_members,
            'monthly_income' => $request->monthly_income,
            'observations' => $request->observations,
            'active' => $request->active
        ]);

        return redirect()->route('participants.index')
            ->with('success', 'Participante atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        // Verifica se o participante tem entregas registradas
        if ($participant->deliveryRecords()->count() > 0) {
            return redirect()->route('participants.index')
                ->with('error', 'Não é possível excluir participante que já recebeu cestas.');
        }

        $participant->delete();

        return redirect()->route('participants.index')
            ->with('success', 'Participante excluído com sucesso!');
    }
}
