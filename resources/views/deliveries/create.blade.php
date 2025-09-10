@extends('layouts.app')

@section('title', 'Nova Entrega')

@section('content')
<div class="container-fluid">
    @if($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="ti-alert-circle me-2"></i>
                        <strong>Erro!</strong>
                    </div>
                    <p class="mb-2 mt-2">Corrija os campos abaixo:</p>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('deliveries.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Formulário Principal -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-edit me-2"></i>Informações da Entrega
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">
                                <i class="ti-bookmark me-1"></i>Título da Entrega
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Ex: Entrega de dezembro de 2025"
                                   required>
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
                                <input type="date"
                                       class="form-control @error('delivery_date') is-invalid @enderror"
                                       id="delivery_date"
                                       name="delivery_date"
                                       value="{{ old('delivery_date') }}"
                                       required>
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
                                <select class="form-select @error('status') is-invalid @enderror"
                                        id="status"
                                        name="status"
                                        required>
                                    <option value="">Selecione o status</option>
                                    <option value="scheduled" {{ old('status', 'scheduled') === 'scheduled' ? 'selected' : '' }}>
                                        Agendada
                                    </option>
                                    <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                                        Em Andamento
                                    </option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>
                                        Concluída
                                    </option>
                                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>
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
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Descreva os itens que serão entregues ou outras informações importantes">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    <i class="ti-alert-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="ti-info-alt me-1"></i>Descrição opcional para identificar melhor a entrega
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti-check me-2"></i>Criar Entrega
                            </button>
                            <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary">
                                <i class="ti-arrow-left me-2"></i>Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Painel de Ajuda -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-help me-2"></i>Guia Rápido
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3 text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 80px; height: 80px;">
                                <i class="ti-package text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <p class="text-muted mt-2 mb-0">Nova Entrega</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-semibold text-dark mb-3">Status da Entrega</h6>
                            <div class="bg-light p-3 rounded">
                                <div class="mb-2">
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning me-2">
                                        <i class="ti-clock me-1"></i>Agendada
                                    </span>
                                    <small class="text-muted">Ainda não iniciada</small>
                                </div>
                                <div class="mb-2">
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info me-2">
                                        <i class="ti-truck me-1"></i>Em Andamento
                                    </span>
                                    <small class="text-muted">Entrega em execução</small>
                                </div>
                                <div class="mb-2">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success me-2">
                                        <i class="ti-check me-1"></i>Concluída
                                    </span>
                                    <small class="text-muted">Todas as entregas feitas</small>
                                </div>
                                <div>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger me-2">
                                        <i class="ti-close me-1"></i>Cancelada
                                    </span>
                                    <small class="text-muted">Entrega cancelada</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-semibold text-dark mb-3">Próximos Passos</h6>
                            <div class="bg-light p-3 rounded">
                                <div class="mb-2 d-flex align-items-center">
                                    <span class="badge bg-primary text-white rounded-circle me-2" style="width: 20px; height: 20px; font-size: 0.7rem;">1</span>
                                    <small>Selecionar participantes</small>
                                </div>
                                <div class="mb-2 d-flex align-items-center">
                                    <span class="badge bg-primary text-white rounded-circle me-2" style="width: 20px; height: 20px; font-size: 0.7rem;">2</span>
                                    <small>Confirmar entregas</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary text-white rounded-circle me-2" style="width: 20px; height: 20px; font-size: 0.7rem;">3</span>
                                    <small>Acompanhar progresso</small>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-semibold text-dark mb-3">Dicas</h6>
                            <div class="bg-info bg-opacity-10 p-3 rounded border border-info">
                                <div class="mb-2">
                                    <i class="ti-lightbulb text-info me-1"></i>
                                    <small>Use títulos descritivos como "Entrega de Dezembro 2025"</small>
                                </div>
                                <div class="mb-2">
                                    <i class="ti-lightbulb text-info me-1"></i>
                                    <small>A data sugerida é o último sábado do mês</small>
                                </div>
                                <div>
                                    <i class="ti-lightbulb text-info me-1"></i>
                                    <small>Comece sempre com status "Agendada"</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
        border-color: #11998e;
        box-shadow: 0 0 0 0.2rem rgba(17, 153, 142, 0.25);
    }

    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .badge {
        font-size: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sugerir data do último sábado do mês atual
    const today = new Date();
    const lastSaturday = getLastSaturdayOfMonth(today.getFullYear(), today.getMonth());

    // Se a data sugerida já passou, usar o próximo mês
    if (lastSaturday < today) {
        const nextMonth = today.getMonth() === 11 ? 0 : today.getMonth() + 1;
        const nextYear = today.getMonth() === 11 ? today.getFullYear() + 1 : today.getFullYear();
        const nextLastSaturday = getLastSaturdayOfMonth(nextYear, nextMonth);
        document.getElementById('delivery_date').value = nextLastSaturday.toISOString().split('T')[0];
    } else {
        document.getElementById('delivery_date').value = lastSaturday.toISOString().split('T')[0];
    }

    // Gerar título automático baseado na data
    document.getElementById('delivery_date').addEventListener('change', function() {
        const date = new Date(this.value);
        if (date && !document.getElementById('title').value) {
            const monthNames = [
                'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
                'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'
            ];
            const monthName = monthNames[date.getMonth()];
            const year = date.getFullYear();
            const title = `Entrega de ${monthName} de ${year}`;
            document.getElementById('title').value = title;
        }
    });

    // Trigger inicial para gerar o título
    if (!document.getElementById('title').value) {
        document.getElementById('delivery_date').dispatchEvent(new Event('change'));
    }
});

function getLastSaturdayOfMonth(year, month) {
    const lastDay = new Date(year, month + 1, 0);
    const lastSaturday = new Date(lastDay);
    lastSaturday.setDate(lastDay.getDate() - ((lastDay.getDay() + 1) % 7));
    return lastSaturday;
}
</script>
@endpush
