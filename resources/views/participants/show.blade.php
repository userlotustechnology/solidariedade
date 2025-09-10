@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Detalhes do Participante</h3>
                <h6 class="font-weight-normal mb-0">Visualize todas as informações do participante</h6>
            </div>
        </div>
    </div>
</div>

<!-- Status do Participante -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert {{ $participant->active ? 'alert-success' : 'alert-warning' }} d-flex align-items-center mb-0">
                            <div class="mr-3">
                                <i class="mdi {{ $participant->active ? 'mdi-check-circle' : 'mdi-alert-circle' }} icon-md"></i>
                            </div>
                            <div>
                                <strong>Status: {{ $participant->active ? 'Participante Ativo' : 'Participante Inativo' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Informações Pessoais -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informações Pessoais</h4>

                <div class="form-group">
                    <label>Nome Completo</label>
                    <div class="bg-light p-3 rounded">
                        <strong>{{ $participant->name }}</strong>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de Documento</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->document_type }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Número do Documento</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->document_number }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data de Nascimento</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->birth_date->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Idade</label>
                            <div class="bg-light p-3 rounded">
                                {{ \Carbon\Carbon::parse($participant->birth_date)->age }} anos
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gênero</label>
                            <div class="bg-light p-3 rounded">
                                @if($participant->gender === 'M')
                                    Masculino
                                @elseif($participant->gender === 'F')
                                    Feminino
                                @elseif($participant->gender === 'Other')
                                    Outro
                                @else
                                    Não informado
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estado Civil</label>
                            <div class="bg-light p-3 rounded">
                                @switch($participant->marital_status)
                                    @case('solteiro')
                                        Solteiro(a)
                                        @break
                                    @case('casado')
                                        Casado(a)
                                        @break
                                    @case('divorciado')
                                        Divorciado(a)
                                        @break
                                    @case('viuvo')
                                        Viúvo(a)
                                        @break
                                    @case('uniao_estavel')
                                        União Estável
                                        @break
                                    @default
                                        Não informado
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telefone</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->phone ?: 'Não informado' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>E-mail</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->email ?: 'Não informado' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Foto do Participante -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Foto</h4>

                <div class="text-center">
                    @if($participant->photo)
                        <img src="{{ asset('storage/' . $participant->photo) }}"
                             alt="Foto de {{ $participant->name }}"
                             class="img-fluid rounded border"
                             style="max-height: 250px; max-width: 100%; object-fit: cover;">
                    @else
                        <div class="border rounded d-flex align-items-center justify-content-center bg-light"
                             style="height: 250px;">
                            <div class="text-center text-muted">
                                <i class="mdi mdi-account icon-lg mb-2"></i>
                                <p class="mb-0">Sem foto</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="form-group mt-3">
                    <label>Data do Cadastro</label>
                    <div class="bg-light p-3 rounded">
                        {{ $participant->registered_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="form-group">
                    <label>Última Atualização</label>
                    <div class="bg-light p-3 rounded">
                        {{ $participant->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Endereço -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Endereço</h4>

                <div class="form-group">
                    <label>Endereço</label>
                    <div class="bg-light p-3 rounded">
                        {{ $participant->address }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Complemento</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->address_complement ?: 'Não informado' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bairro</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->neighborhood }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cidade</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->city }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Estado</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->state }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>CEP</label>
                            <div class="bg-light p-3 rounded">
                                {{ $participant->zip_code }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informações Familiares -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informações Familiares</h4>

                <div class="form-group">
                    <label>Pessoas na Família</label>
                    <div class="bg-light p-3 rounded">
                        <strong>{{ $participant->family_members }}</strong>
                        {{ $participant->family_members === 1 ? 'pessoa' : 'pessoas' }}
                    </div>
                </div>

                <div class="form-group">
                    <label>Renda Mensal Familiar</label>
                    <div class="bg-light p-3 rounded">
                        @if($participant->monthly_income)
                            <strong>R$ {{ number_format($participant->monthly_income, 2, ',', '.') }}</strong>
                        @else
                            Não informado
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Renda per capita</label>
                    <div class="bg-light p-3 rounded">
                        @if($participant->monthly_income)
                            <strong>R$ {{ number_format($participant->monthly_income / $participant->family_members, 2, ',', '.') }}</strong>
                        @else
                            Não calculado
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Benefícios e Documentação -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Benefícios e Documentação</h4>

                <div class="form-group">
                    <label>Recebe Benefício do Governo</label>
                    <div class="bg-light p-3 rounded">
                        @if($participant->receives_government_benefit)
                            <span class="badge badge-success">Sim</span>
                        @else
                            <span class="badge badge-secondary">Não</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Tipo de Benefício</label>
                    <div class="bg-light p-3 rounded">
                        {{ $participant->government_benefit_type ?: 'Não informado' }}
                    </div>
                </div>

                <div class="form-group">
                    <label>Possui Documentos Básicos</label>
                    <div class="bg-light p-3 rounded">
                        @if($participant->has_documents)
                            <span class="badge badge-success">Sim</span>
                        @else
                            <span class="badge badge-warning">Não</span>
                        @endif
                        <br><small class="text-muted">RG, CPF, Comprovante de residência</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Situação Trabalhista -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Situação Trabalhista</h4>

                <div class="form-group">
                    <label>Situação de Trabalho</label>
                    <div class="bg-light p-3 rounded">
                        @switch($participant->employment_status)
                            @case('empregado')
                                <span class="badge badge-success">Empregado</span>
                                @break
                            @case('desempregado')
                                <span class="badge badge-danger">Desempregado</span>
                                @break
                            @case('aposentado')
                                <span class="badge badge-info">Aposentado</span>
                                @break
                            @case('pensionista')
                                <span class="badge badge-info">Pensionista</span>
                                @break
                            @case('autonomo')
                                <span class="badge badge-warning">Autônomo</span>
                                @break
                            @default
                                Não informado
                        @endswitch
                    </div>
                </div>

                <div class="form-group">
                    <label>Local de Trabalho</label>
                    <div class="bg-light p-3 rounded">
                        {{ $participant->workplace ?: 'Não informado' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($participant->observations)
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Observações</h4>
                    <div class="bg-light p-3 rounded">
                        {{ $participant->observations }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Histórico de Entregas -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Histórico de Entregas</h4>

                @if($participant->deliveryRecords->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Entrega</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Documento Verificado</th>
                                    <th>Observações</th>
                                    <th>Registrado em</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participant->deliveryRecords->sortByDesc('created_at') as $record)
                                    <tr>
                                        <td>
                                            <strong>{{ $record->delivery->title }}</strong>
                                        </td>
                                        <td>{{ $record->delivery->delivery_date->format('d/m/Y') }}</td>
                                        <td>
                                            @switch($record->delivery->status)
                                                @case('scheduled')
                                                    <span class="badge badge-warning">Agendada</span>
                                                    @break
                                                @case('in_progress')
                                                    <span class="badge badge-info">Em Andamento</span>
                                                    @break
                                                @case('completed')
                                                    <span class="badge badge-success">Concluída</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge badge-danger">Cancelada</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($record->document_verified)
                                                <span class="badge badge-success">Sim</span>
                                            @else
                                                <span class="badge badge-warning">Não</span>
                                            @endif
                                        </td>
                                        <td>{{ $record->notes ?: '-' }}</td>
                                        <td>{{ $record->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="mdi mdi-package-variant icon-lg mb-2"></i>
                        <p class="mb-0">Nenhuma entrega registrada para este participante</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Ações -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        @can('participants.update')
                            <a href="{{ route('participants.edit', $participant) }}" class="btn btn-warning">
                                Editar Participante
                            </a>
                        @endcan
                        <a href="{{ route('participants.print', $participant) }}" class="btn btn-info" target="_blank">
                            Imprimir Ficha
                        </a>
                    </div>
                    <div>
                        @can('deliveries.manage')
                            @if($participant->active)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#deliveryModal">
                                    Registrar Entrega
                                </button>
                            @endif
                        @endcan
                        <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                            Lista de Participantes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@can('deliveries.manage')
<!-- Modal para Registrar Entrega -->
<div class="modal fade" id="deliveryModal" tabindex="-1" role="dialog" aria-labelledby="deliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deliveryModalLabel">Registrar Entrega para {{ $participant->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delivery-records.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="participant_id" value="{{ $participant->id }}">

                    <div class="form-group">
                        <label for="delivery_id">Entrega</label>
                        <select name="delivery_id" id="delivery_id" class="form-control" required>
                            <option value="">Selecione uma entrega</option>
                            @if(isset($availableDeliveries))
                                @foreach($availableDeliveries as $delivery)
                                    <option value="{{ $delivery->id }}">
                                        {{ $delivery->title }} - {{ $delivery->delivery_date->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="document_verified">Documento Verificado?</label>
                        <select name="document_verified" id="document_verified" class="form-control" required>
                            <option value="1">Sim, documento foi verificado</option>
                            <option value="0">Não foi possível verificar o documento</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="notes">Observações</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Observações sobre a entrega..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        Registrar Entrega
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

@endsection
