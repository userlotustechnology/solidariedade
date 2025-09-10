<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
            'address_complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',
            'zip_code' => 'required|string|max:10',
            'gender' => 'nullable|in:M,F,Other',
            'marital_status' => 'nullable|string|in:solteiro,casado,divorciado,viuvo,uniao_estavel',
            'family_members' => 'required|integer|min:1|max:20',
            'monthly_income' => 'nullable|numeric|min:0',
            'receives_government_benefit' => 'nullable|boolean',
            'government_benefit_type' => 'nullable|string|max:255',
            'employment_status' => 'nullable|in:empregado,desempregado,aposentado,pensionista,autonomo',
            'workplace' => 'nullable|string|max:255',
            'has_documents' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'observations' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Upload da foto se fornecida
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('participants/photos', 'public');
        }

        $participant = Participant::create([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'document_number' => preg_replace('/\D/', '', $request->document_number),
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'address_complement' => $request->address_complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => strtoupper($request->state),
            'zip_code' => preg_replace('/\D/', '', $request->zip_code),
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'family_members' => $request->family_members,
            'monthly_income' => $request->monthly_income,
            'receives_government_benefit' => $request->receives_government_benefit === '1',
            'government_benefit_type' => $request->government_benefit_type,
            'employment_status' => $request->employment_status,
            'workplace' => $request->workplace,
            'has_documents' => $request->has_documents === '1',
            'photo' => $photoPath,
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
            'address_complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',
            'zip_code' => 'required|string|max:10',
            'gender' => 'nullable|in:M,F,Other',
            'marital_status' => 'nullable|string|in:solteiro,casado,divorciado,viuvo,uniao_estavel',
            'family_members' => 'required|integer|min:1|max:20',
            'monthly_income' => 'nullable|numeric|min:0',
            'receives_government_benefit' => 'nullable|boolean',
            'government_benefit_type' => 'nullable|string|max:255',
            'employment_status' => 'nullable|in:empregado,desempregado,aposentado,pensionista,autonomo',
            'workplace' => 'nullable|string|max:255',
            'has_documents' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'observations' => 'nullable|string|max:1000',
            'active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Upload da nova foto se fornecida
        $photoPath = $participant->photo; // Mantém a foto atual
        if ($request->hasFile('photo')) {
            // Remove a foto antiga se existir
            if ($participant->photo && file_exists(storage_path('app/public/' . $participant->photo))) {
                unlink(storage_path('app/public/' . $participant->photo));
            }
            $photoPath = $request->file('photo')->store('participants/photos', 'public');
        }

        $participant->update([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'document_number' => preg_replace('/\D/', '', $request->document_number),
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'address_complement' => $request->address_complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => strtoupper($request->state),
            'zip_code' => preg_replace('/\D/', '', $request->zip_code),
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'family_members' => $request->family_members,
            'monthly_income' => $request->monthly_income,
            'receives_government_benefit' => $request->receives_government_benefit === '1',
            'government_benefit_type' => $request->government_benefit_type,
            'employment_status' => $request->employment_status,
            'workplace' => $request->workplace,
            'has_documents' => $request->has_documents === '1',
            'photo' => $photoPath,
            'observations' => $request->observations,
            'active' => $request->active
        ]);

        return redirect()->route('participants.index')
            ->with('success', 'Participante atualizado com sucesso!');
    }

    /**
     * Show participant card for viewing/printing
     */
    public function showCard(Participant $participant)
    {
        $participant->load(['registeredBy', 'deliveryRecords.delivery', 'deliveryRecords.deliveredBy']);
        return view('participants.card-image', compact('participant'));
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
