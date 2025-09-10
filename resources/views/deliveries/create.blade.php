@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Nova Entrega</h3>
                <h6 class="font-weight-normal mb-0">Crie uma nova entrega para os participantes</h6>
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
                        <label for="title">Título da Entrega</label>
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="delivery_date">Data da Entrega</label>
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
                                <label for="status">Status</label>
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
                </div>
            </div>
        </div>

        <!-- Informações -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações</h4>

                    <div class="mb-3 text-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width: 100px; height: 100px;">
                            <i class="ti-package" style="font-size: 2.5rem; color: #ccc;"></i>
                        </div>
                        <p class="text-muted mt-2 small">Nova entrega</p>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Status da Entrega</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="d-flex align-items-center">
                                <i class="ti-calendar text-warning me-2"></i>
                                <div>
                                    <strong>Agendada</strong>
                                    <br>
                                    <small class="text-muted">Entrega criada como agendada</small>
                                </div>
                            </div>
                        </div>
                        <small class="form-text text-muted">Entregas são criadas como agendadas por padrão</small>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Próximos Passos</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="mb-2">
                                <i class="ti-users text-success me-1"></i>
                                <small>Selecionar participantes</small>
                            </div>
                            <div class="mb-2">
                                <i class="ti-check text-primary me-1"></i>
                                <small>Realizar entregas</small>
                            </div>
                            <div>
                                <i class="ti-clipboard text-info me-1"></i>
                                <small>Registrar ocorrências</small>
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
@endsection
