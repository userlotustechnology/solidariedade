@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Novo Usuário</h3>
                <h6 class="font-weight-normal mb-0">Adicione um novo usuário ao sistema</h6>
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

<form action="{{ route('users.store') }}" method="POST">
    @csrf

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
                               value="{{ old('name') }}"
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
                               value="{{ old('email') }}"
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
                                <label for="password">Senha</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Mínimo 8 caracteres"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Senha</label>
                                <input type="password"
                                       class="form-control"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Digite a senha novamente"
                                       required>
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
                            <i class="ti-user" style="font-size: 2.5rem; color: #ccc;"></i>
                        </div>
                        <p class="text-muted mt-2 small">Avatar padrão</p>
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
                        <small class="form-text text-muted">Todos os usuários têm permissões administrativas</small>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Informações</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="mb-2">
                                <i class="ti-shield text-success me-1"></i>
                                <small>Acesso a usuários</small>
                            </div>
                            <div class="mb-2">
                                <i class="ti-user text-primary me-1"></i>
                                <small>Acesso a participantes</small>
                            </div>
                            <div>
                                <i class="ti-package text-info me-1"></i>
                                <small>Acesso a entregas</small>
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
                            <i class="ti-check"></i> Criar Usuário
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
