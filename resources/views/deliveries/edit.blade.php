@extends('layouts.app')

@section('title', 'Editar Entrega')

@section('content')
<div class="container-fluid">

    <!-- Formulário de Edição -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-primary fw-bold mb-0">
                        <i class="ti-edit me-2"></i>Informações da Entrega
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('deliveries.update', $delivery) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">
                                <i class="ti-bookmark me-1"></i>Título da Entrega
                                <span class="text-danger">*</span>
                            </label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ old('title', $delivery->title) }}" required autofocus
                                   placeholder="Digite o título da entrega">
                            @error('title')
                                <div class="invalid-feedback">
                                    <i class="ti-alert-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="delivery_date" class="form-label fw-semibold">
                                    <i class="ti-calendar me-1"></i>Data da Entrega
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="delivery_date" type="date" class="form-control @error('delivery_date') is-invalid @enderror"
                                       name="delivery_date" value="{{ old('delivery_date', $delivery->delivery_date->format('Y-m-d')) }}" required>
                                @error('delivery_date')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold">
                                    <i class="ti-flag me-1"></i>Status
                                    <span class="text-danger">*</span>
                                </label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                                    <option value="">Selecione o status</option>
                                    <option value="scheduled" {{ old('status', $delivery->status) === 'scheduled' ? 'selected' : '' }}>
                                        Agendada
                                    </option>
                                    <option value="in_progress" {{ old('status', $delivery->status) === 'in_progress' ? 'selected' : '' }}>
                                        Em Andamento
                                    </option>
                                    <option value="completed" {{ old('status', $delivery->status) === 'completed' ? 'selected' : '' }}>
                                        Concluída
                                    </option>
                                    <option value="cancelled" {{ old('status', $delivery->status) === 'cancelled' ? 'selected' : '' }}>
                                        Cancelada
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="ti-file-text me-1"></i>Descrição
                            </label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                                      name="description" rows="4"
                                      placeholder="Digite uma descrição opcional para a entrega">{{ old('description', $delivery->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    <i class="ti-alert-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti-check me-2"></i>Atualizar Entrega
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Informações Complementares -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-primary fw-bold mb-0">
                        <i class="ti-info me-2"></i>Informações da Entrega
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <div class="fw-semibold text-muted mb-2">
                            <i class="ti-clock me-1"></i>Data de Criação
                        </div>
                        <div class="bg-light rounded p-3">
                            {{ $delivery->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="fw-semibold text-muted mb-2">
                            <i class="ti-refresh me-1"></i>Última Atualização
                        </div>
                        <div class="bg-light rounded p-3">
                            {{ $delivery->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="fw-semibold text-muted mb-2">
                            <i class="ti-users me-1"></i>Participantes
                        </div>
                        <div class="bg-light rounded p-3">
                            {{ $delivery->deliveryRecords()->count() }} registros
                        </div>
                    </div>

                    @php
                        $presentCount = $delivery->deliveryRecords()->whereNotNull('delivered_at')->count();
                        $totalRecords = $delivery->deliveryRecords()->count();
                        $progressPercentage = $totalRecords > 0 ? ($presentCount / $totalRecords) * 100 : 0;
                    @endphp

                    <div class="mb-3">
                        <div class="fw-semibold text-muted mb-2">
                            <i class="ti-bar-chart me-1"></i>Progresso da Entrega
                        </div>
                        <div class="bg-light rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ $presentCount }}/{{ $totalRecords }}</span>
                                <span class="fw-bold">{{ number_format($progressPercentage, 1) }}%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-3 mt-3">
                        <div class="fw-semibold text-muted mb-2">
                            <i class="ti-settings me-1"></i>Ações Rápidas
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('deliveries.show', $delivery) }}" class="btn btn-outline-primary btn-sm">
                                <i class="ti-users me-1"></i>Ver Participantes
                            </a>
                            <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="ti-list me-1"></i>Lista de Entregas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .progress {
        border-radius: 0.5rem;
    }

    .progress-bar {
        border-radius: 0.5rem;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.6) !important;
    }
</style>
@endpush
