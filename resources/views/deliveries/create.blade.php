@extends('layouts.sidebar-simple')

@section('page-title', 'Nova Entrega')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Nova Entrega') }}</h4>
                    <a href="{{ route('deliveries.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('deliveries.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="title" class="form-label">{{ __('Título da Entrega') }} <span class="text-danger">*</span></label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ old('title') }}" required autofocus
                                       placeholder="Ex: Entrega de dezembro de 2025">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="delivery_date" class="form-label">{{ __('Data da Entrega') }} <span class="text-danger">*</span></label>
                                <input id="delivery_date" type="date" class="form-control @error('delivery_date') is-invalid @enderror"
                                       name="delivery_date" value="{{ old('delivery_date') }}" required>
                                @error('delivery_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                                    <option value="">Selecione o status</option>
                                    <option value="scheduled" {{ old('status') === 'scheduled' ? 'selected' : '' }}>Agendada</option>
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
