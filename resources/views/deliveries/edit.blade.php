@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Editar Entrega</h3>
                <h6 class="font-weight-normal mb-0">Edite as informações da entrega</h6>
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

<form action="{{ route('deliveries.update', $delivery) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Informações da Entrega -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações da Entrega</h4>

                    <div class="form-group">
                        <label for="title">Título da Entrega</label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title', $delivery->title) }}"
                               placeholder="Digite o título da entrega"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="delivery_date">Data da Entrega</label>
                                <input type="date"
                                       class="form-control @error('delivery_date') is-invalid @enderror"
                                       id="delivery_date"
                                       name="delivery_date"
                                       value="{{ old('delivery_date', $delivery->delivery_date->format('Y-m-d')) }}"
                                       required>
                                @error('delivery_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        id="status"
                                        name="status"
                                        required>
                                    <option value="">Selecione o status</option>
                                    <option value="scheduled" {{ old('status', $delivery->status) === 'scheduled' ? 'selected' : '' }}>Agendada</option>
                                    <option value="in_progress" {{ old('status', $delivery->status) === 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="completed" {{ old('status', $delivery->status) === 'completed' ? 'selected' : '' }}>Concluída</option>
                                    <option value="cancelled" {{ old('status', $delivery->status) === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Descreva os itens que serão entregues ou outras informações importantes">{{ old('description', $delivery->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Descrição opcional para identificar melhor a entrega</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Painel de Informações -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações da Entrega</h4>

                    <div class="form-group">
                        <label>Status Atual</label>
                        <div class="bg-light p-3 rounded">
                            @php
                                $statusLabels = [
                                    'scheduled' => 'Agendada',
                                    'in_progress' => 'Em Andamento',
                                    'completed' => 'Concluída',
                                    'cancelled' => 'Cancelada'
                                ];
                                $statusColors = [
                                    'scheduled' => 'warning',
                                    'in_progress' => 'info',
                                    'completed' => 'success',
                                    'cancelled' => 'danger'
                                ];
                            @endphp
                            <span class="badge badge-{{ $statusColors[$delivery->status] ?? 'warning' }}">
                                {{ $statusLabels[$delivery->status] ?? 'Agendada' }}
                            </span>
                            <br>
                            <small class="text-muted">Status atual da entrega</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Data de Criação</label>
                        <div class="bg-light p-3 rounded">
                            <strong>{{ $delivery->created_at->format('d/m/Y H:i') }}</strong>
                            <br>
                            <small class="text-muted">Entrega criada em</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Participantes</label>
                        <div class="bg-light p-3 rounded">
                            <strong>{{ $delivery->participants->count() }} participante(s)</strong>
                            <br>
                            <small class="text-muted">Selecionados para esta entrega</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ações Rápidas</label>
                        <div class="d-grid gap-2">
                            <a href="{{ route('deliveries.show', $delivery) }}" class="btn btn-outline-info btn-sm">
                                Ver Detalhes
                            </a>
                            @if($delivery->participants->count() > 0)
                                <a href="{{ route('deliveries.show', $delivery) }}#participants" class="btn btn-outline-primary btn-sm">
                                    Gerenciar Participantes
                                </a>
                            @endif
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
                        <div>
                            <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary">
                                Voltar para Lista
                            </a>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Atualizar Entrega
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
