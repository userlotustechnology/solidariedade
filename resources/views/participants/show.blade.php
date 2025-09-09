@extends('layouts.app')

@section('page-title', 'Detalhes do Participante')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Detalhes do Participante') }}</h4>
                    <div>
                        @can('participants.update')
                            <a href="{{ route('participants.edit', $participant) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        @endcan
                        <a href="{{ route('participants.print', $participant) }}" class="btn btn-info" target="_blank">
                            <i class="fas fa-print"></i> Imprimir Ficha
                        </a>
                        <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Status do Participante -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert {{ $participant->active ? 'alert-success' : 'alert-warning' }} d-flex align-items-center">
                                <i class="fas {{ $participant->active ? 'fa-check-circle' : 'fa-exclamation-triangle' }} me-2"></i>
                                <strong>Status: {{ $participant->active ? 'Participante Ativo' : 'Participante Inativo' }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Informações Pessoais -->
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <h5 class="text-primary d-flex align-items-center">
                                <i class="fas fa-user me-2"></i>
                                Informações Pessoais
                            </h5>
                            <hr>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5 class="text-primary d-flex align-items-center">
                                <i class="fas fa-camera me-2"></i>
                                Foto
                            </h5>
                            <hr>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="fw-bold text-muted mb-1">{{ __('Nome Completo') }}</div>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->name }}</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="fw-bold text-muted mb-1">{{ __('Idade') }}</div>
                                    <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->age }} anos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                @if($participant->photo)
                                    <img src="{{ asset('storage/' . $participant->photo) }}"
                                         alt="Foto de {{ $participant->name }}"
                                         class="img-fluid rounded border"
                                         style="max-height: 200px; max-width: 200px; object-fit: cover;">
                                @else
                                    <div class="border rounded d-flex align-items-center justify-content-center bg-light"
                                         style="height: 200px; width: 200px; margin: 0 auto;">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-user fa-3x mb-2"></i>
                                            <p class="mb-0">Sem foto</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Gênero') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                @if($participant->gender === 'M')
                                    Masculino
                                @elseif($participant->gender === 'F')
                                    Feminino
                                @elseif($participant->gender === 'Other')
                                    Outro
                                @else
                                    Não informado
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Estado Civil') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
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
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="fw-bold text-muted mb-1">{{ __('Tipo de Documento') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->document_type }}</p>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-bold text-muted mb-1">{{ __('Número do Documento') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->formatted_document }}</p>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-bold text-muted mb-1">{{ __('Data de Nascimento') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->birth_date->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="fw-bold text-muted mb-1">{{ __('Celular') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $participant->formatted_phone ?: 'Não informado' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-bold text-muted mb-1">{{ __('E-mail') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $participant->email ?: 'Não informado' }}
                            </p>
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-primary d-flex align-items-center">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                Endereço
                            </h5>
                            <hr>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="fw-bold text-muted mb-1">{{ __('Endereço') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->address }}</p>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-bold text-muted mb-1">{{ __('Complemento') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->address_complement ?: 'Não informado' }}</p>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-bold text-muted mb-1">{{ __('Bairro') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->neighborhood }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-5">
                            <div class="fw-bold text-muted mb-1">{{ __('Cidade') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->city }}</p>
                        </div>
                        <div class="col-md-2">
                            <div class="fw-bold text-muted mb-1">{{ __('Estado') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->state }}</p>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-bold text-muted mb-1">{{ __('CEP') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->zip_code }}</p>
                        </div>
                    </div>

                    <!-- Informações Familiares -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-primary d-flex align-items-center">
                                <i class="fas fa-users me-2"></i>
                                Informações Familiares
                            </h5>
                            <hr>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Pessoas na Família') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $participant->family_members }}
                                {{ $participant->family_members === 1 ? 'pessoa' : 'pessoas' }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Renda Mensal Familiar') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                @if($participant->monthly_income)
                                    R$ {{ number_format($participant->monthly_income, 2, ',', '.') }}
                                @else
                                    Não informado
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Renda per capita') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                @if($participant->monthly_income)
                                    R$ {{ number_format($participant->monthly_income / $participant->family_members, 2, ',', '.') }}
                                @else
                                    Não calculado
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Benefícios e Documentação -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-primary d-flex align-items-center">
                                <i class="fas fa-file-alt me-2"></i>
                                Benefícios e Documentação
                            </h5>
                            <hr>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Recebe Benefício do Governo') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                @if($participant->receives_government_benefit)
                                    <span class="badge bg-success">Sim</span>
                                @else
                                    <span class="badge bg-secondary">Não</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Tipo de Benefício') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $participant->government_benefit_type ?: 'Não informado' }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Possui Documentos Básicos') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                @if($participant->has_documents)
                                    <span class="badge bg-success">Sim</span>
                                @else
                                    <span class="badge bg-warning">Não</span>
                                @endif
                                <br><small class="text-muted">RG, CPF, Comprovante de residência</small>
                            </p>
                        </div>
                    </div>

                    <!-- Situação Trabalhista -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-primary d-flex align-items-center">
                                <i class="fas fa-briefcase me-2"></i>
                                Situação Trabalhista
                            </h5>
                            <hr>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="fw-bold text-muted mb-1">{{ __('Situação de Trabalho') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                @switch($participant->employment_status)
                                    @case('empregado')
                                        <span class="badge bg-success">Empregado</span>
                                        @break
                                    @case('desempregado')
                                        <span class="badge bg-danger">Desempregado</span>
                                        @break
                                    @case('aposentado')
                                        <span class="badge bg-info">Aposentado</span>
                                        @break
                                    @case('pensionista')
                                        <span class="badge bg-info">Pensionista</span>
                                        @break
                                    @case('autonomo')
                                        <span class="badge bg-warning">Autônomo</span>
                                        @break
                                    @default
                                        Não informado
                                @endswitch
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-bold text-muted mb-1">{{ __('Local de Trabalho') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $participant->workplace ?: 'Não informado' }}
                            </p>
                        </div>
                    </div>

                    @if($participant->observations)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="fw-bold text-muted mb-1">{{ __('Observações') }}</div>
                                <div class="border rounded p-3 bg-light">
                                    {{ $participant->observations }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Histórico de Entregas -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-primary d-flex align-items-center">
                                <i class="fas fa-history me-2"></i>
                                Histórico de Entregas
                            </h5>
                            <hr>
                        </div>
                    </div>

                    @if($participant->deliveryRecords->count() > 0)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Data da Entrega</th>
                                                <th>Título</th>
                                                <th>Data do Recebimento</th>
                                                <th>Entregue por</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($participant->deliveryRecords->sortByDesc('delivery.delivery_date') as $record)
                                                <tr>
                                                    <td>{{ $record->delivery->delivery_date->format('d/m/Y') }}</td>
                                                    <td>{{ $record->delivery->title }}</td>
                                                    <td>
                                                        @if($record->delivered_at)
                                                            {{ $record->delivered_at->format('d/m/Y H:i') }}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($record->deliveredBy)
                                                            {{ $record->deliveredBy->name }}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($record->delivered_at)
                                                            <span class="badge bg-success">
                                                                <i class="fas fa-check"></i> Recebido
                                                            </span>
                                                        @else
                                                            <span class="badge bg-warning">
                                                                <i class="fas fa-clock"></i> Pendente
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Estatísticas de Entregas -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">
                                            <i class="fas fa-check-circle"></i>
                                            Cestas Recebidas
                                        </h5>
                                        <h3 class="card-text">{{ $participant->deliveryRecords->whereNotNull('delivered_at')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">
                                            <i class="fas fa-clock"></i>
                                            Cestas Pendentes
                                        </h5>
                                        <h3 class="card-text">{{ $participant->deliveryRecords->whereNull('delivered_at')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">
                                            <i class="fas fa-box"></i>
                                            Total de Entregas
                                        </h5>
                                        <h3 class="card-text">{{ $participant->deliveryRecords->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Este participante ainda não possui histórico de entregas.
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Informações de Cadastro -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-secondary d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                Informações de Cadastro
                            </h5>
                            <hr>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Cadastrado por') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->registeredBy->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Data do Cadastro') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->registered_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-4">
                            <div class="fw-bold text-muted mb-1">{{ __('Última Atualização') }}</div>
                            <p class="form-control-plaintext border rounded p-2 bg-light">{{ $participant->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Ações -->
                    <div class="row mb-0">
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                @can('participants.update')
                                    <a href="{{ route('participants.edit', $participant) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> {{ __('Editar Participante') }}
                                    </a>
                                @endcan

                                <a href="{{ route('participants.print', $participant) }}" class="btn btn-info" target="_blank">
                                    <i class="fas fa-print"></i> {{ __('Imprimir Ficha') }}
                                </a>

                                @can('deliveries.manage')
                                    @if($participant->active)
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deliveryModal">
                                            <i class="fas fa-box"></i> {{ __('Registrar Entrega') }}
                                        </button>
                                    @endif
                                @endcan

                                <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-list"></i> {{ __('Lista de Participantes') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@can('deliveries.manage')
<!-- Modal para Registrar Entrega -->
<div class="modal fade" id="deliveryModal" tabindex="-1" aria-labelledby="deliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deliveryModalLabel">Registrar Entrega para {{ $participant->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('delivery-records.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="participant_id" value="{{ $participant->id }}">

                    <div class="mb-3">
                        <label for="delivery_id" class="form-label">{{ __('Entrega') }}</label>
                        <select name="delivery_id" id="delivery_id" class="form-select" required>
                            <option value="">Selecione uma entrega</option>
                            @foreach($availableDeliveries as $delivery)
                                <option value="{{ $delivery->id }}">
                                    {{ $delivery->title }} - {{ $delivery->delivery_date->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="document_verified" class="form-label">{{ __('Documento Verificado?') }}</label>
                        <select name="document_verified" id="document_verified" class="form-select" required>
                            <option value="1">Sim, documento foi verificado</option>
                            <option value="0">Não foi possível verificar o documento</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">{{ __('Observações') }}</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Observações sobre a entrega..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Registrar Entrega
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
