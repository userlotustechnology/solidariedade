@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('deliveries.index') }}">Entregas</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Nova Entrega</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Nova Entrega</h3>
                <h6 class="font-weight-normal mb-0">Crie uma nova entrega para distribuição aos participantes</h6>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Corrija os campos abaixo:
                <ul class="mb-0 mt-2">
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
        <!-- Informações da Entrega -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações da Entrega</h4>

                    <div class="form-group">
                        <label for="title">Título da Entrega <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Ex: Entrega de dezembro de 2025"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Descreva os itens que serão entregues ou outras informações importantes">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Descrição opcional para identificar melhor a entrega</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="delivery_date">Data da Entrega <span class="text-danger">*</span></label>
                                <input type="date"
                                       class="form-control @error('delivery_date') is-invalid @enderror"
                                       id="delivery_date"
                                       name="delivery_date"
                                       value="{{ old('delivery_date') }}"
                                       required>
                                @error('delivery_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        id="status"
                                        name="status"
                                        required>
                                    <option value="">Selecione o status</option>
                                    <option value="scheduled" {{ old('status', 'scheduled') === 'scheduled' ? 'selected' : '' }}>Agendada</option>
                                    <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Concluída</option>
                                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Configurações -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Configurações</h4>

                    <div class="mb-3 text-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width: 100px; height: 100px;">
                            <i class="ti-package" style="font-size: 2.5rem; color: #ccc;"></i>
                        </div>
                        <p class="text-muted mt-2 small">Nova Entrega</p>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Status da Entrega</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="mb-2">
                                <i class="ti-time text-primary me-1"></i>
                                <small><strong>Agendada:</strong> Ainda não iniciada</small>
                            </div>
                            <div class="mb-2">
                                <i class="ti-truck text-warning me-1"></i>
                                <small><strong>Em Andamento:</strong> Entrega em execução</small>
                            </div>
                            <div class="mb-2">
                                <i class="ti-check text-success me-1"></i>
                                <small><strong>Concluída:</strong> Todas as entregas feitas</small>
                            </div>
                            <div>
                                <i class="ti-close text-danger me-1"></i>
                                <small><strong>Cancelada:</strong> Entrega cancelada</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Próximos Passos</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="mb-2">
                                <i class="ti-user text-info me-1"></i>
                                <small>1. Selecionar participantes</small>
                            </div>
                            <div class="mb-2">
                                <i class="ti-check text-success me-1"></i>
                                <small>2. Confirmar entregas</small>
                            </div>
                            <div>
                                <i class="ti-clipboard text-warning me-1"></i>
                                <small>3. Acompanhar progresso</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary">
                            <i class="ti-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-check"></i> Criar Entrega
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
                                    <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Concluída</option>
                                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="description" class="form-label">{{ __('Descrição') }}</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                                          name="description" rows="4"
                                          placeholder="Informações adicionais sobre esta entrega...">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ __('Criar Entrega') }}
                                </button>
                                <a href="{{ route('deliveries.index') }}" class="btn btn-secondary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        if (date) {
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
    document.getElementById('delivery_date').dispatchEvent(new Event('change'));
});

function getLastSaturdayOfMonth(year, month) {
    const lastDay = new Date(year, month + 1, 0);
    const lastSaturday = new Date(lastDay);
    lastSaturday.setDate(lastDay.getDate() - ((lastDay.getDay() + 1) % 7));
    return lastSaturday;
}
</script>
@endpush
