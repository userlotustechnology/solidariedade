@extends('layouts.sidebar-simple')

@section('page-title', 'Editar Entrega')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Editar Entrega') }}</h4>
                    <div>
                        <a href="{{ route('deliveries.show', $delivery) }}" class="btn btn-info">
                            <i class="fas fa-users"></i> Participantes
                        </a>
                        <a href="{{ route('deliveries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('deliveries.update', $delivery) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="title" class="form-label">{{ __('Título da Entrega') }} <span class="text-danger">*</span></label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ old('title', $delivery->title) }}" required autofocus>
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
                                       name="delivery_date" value="{{ old('delivery_date', $delivery->delivery_date->format('Y-m-d')) }}" required>
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
                                    <option value="scheduled" {{ old('status', $delivery->status) === 'scheduled' ? 'selected' : '' }}>Agendada</option>
                                    <option value="in_progress" {{ old('status', $delivery->status) === 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="completed" {{ old('status', $delivery->status) === 'completed' ? 'selected' : '' }}>Concluída</option>
                                    <option value="cancelled" {{ old('status', $delivery->status) === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
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
                                          name="description" rows="4">{{ old('description', $delivery->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Informações da Entrega -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-secondary">Informações da Entrega</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold text-muted mb-1">{{ __('Data de Criação') }}</div>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $delivery->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-4">
                                <div class="fw-bold text-muted mb-1">{{ __('Última Atualização') }}</div>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $delivery->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-4">
                                <div class="fw-bold text-muted mb-1">{{ __('Registros de Entrega') }}</div>
                                <p class="form-control-plaintext border rounded p-2 bg-light">{{ $delivery->deliveryRecords()->count() }} participantes</p>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ __('Atualizar Entrega') }}
                                </button>
                                <a href="{{ route('deliveries.show', $delivery) }}" class="btn btn-info">
                                    <i class="fas fa-users"></i> {{ __('Gerenciar Participantes') }}
                                </a>
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
