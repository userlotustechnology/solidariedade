@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('users.index') }}">Usuários</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Editar Usuário</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Editar Usuário</h3>
                <h6 class="font-weight-normal mb-0">Atualize as informações do usuário {{ $user->name }}</h6>
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

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Informações Básicas -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações Básicas</h4>

                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               placeholder="Digite o nome completo do usuário"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               placeholder="usuario@exemplo.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Este será o login do usuário no sistema</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Nova Senha</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Deixe em branco para manter a atual">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Mínimo 8 caracteres (opcional)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Nova Senha</label>
                                <input type="password"
                                       class="form-control"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Digite a senha novamente">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações do Usuário -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações do Usuário</h4>

                    <div class="mb-3 text-center">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                             style="width: 100px; height: 100px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <p class="text-muted mt-2 small">{{ $user->name }}</p>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Tipo de Usuário</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="d-flex align-items-center">
                                <i class="ti-crown text-warning me-2"></i>
                                <div>
                                    <strong>Administrador</strong>
                                    <br>
                                    <small class="text-muted">Acesso completo ao sistema</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Estatísticas</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Cadastrado em:</span>
                                <strong>{{ $user->created_at->format('d/m/Y') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Último acesso:</span>
                                <strong>
                                    @if($user->updated_at)
                                        {{ $user->updated_at->format('d/m/Y') }}
                                    @else
                                        Nunca
                                    @endif
                                </strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Status:</span>
                                <span class="badge bg-success">Ativo</span>
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
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="ti-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-check"></i> Atualizar Usuário
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Nova Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password">
                                <small class="form-text text-muted">Deixe em branco para manter a senha atual</small>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Nova Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <p class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Todos os usuários têm acesso administrativo completo ao sistema.
                                </p>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Atualizar Usuário') }}
                                </button>
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
