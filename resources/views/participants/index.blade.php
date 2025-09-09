@extends('layouts.sidebar-simple')

@section('page-title', 'Gerenciar Participantes')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Participantes Cadastrados') }}</h4>
                    <a href="{{ route('participants.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Novo Participante
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filtros -->
                    <form method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Buscar por nome ou documento...">
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select">
                                    <option value="">Todos os Status</option>
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Ativos</option>
                                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inativos</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-search"></i> Filtrar
                                </button>
                                <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Limpar
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Documento</th>
                                    <th>Celular</th>
                                    <th>Família</th>
                                    <th>Status</th>
                                    <th>Cadastrado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participants as $participant)
                                    <tr>
                                        <td>{{ $participant->id }}</td>
                                        <td>{{ $participant->name }}</td>
                                        <td>
                                            <small class="text-muted">{{ $participant->document_type }}</small><br>
                                            {{ $participant->formatted_document }}
                                        </td>
                                        <td>{{ $participant->formatted_phone ?: '-' }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $participant->family_members }}
                                                {{ $participant->family_members == 1 ? 'pessoa' : 'pessoas' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($participant->active)
                                                <span class="badge bg-success">Ativo</span>
                                            @else
                                                <span class="badge bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>{{ $participant->registered_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('participants.show', $participant) }}"
                                                   class="btn btn-sm btn-info" title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('participants.edit', $participant) }}"
                                                   class="btn btn-sm btn-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('participants.destroy', $participant) }}"
                                                      method="POST" style="display: inline;"
                                                      onsubmit="return confirm('Tem certeza que deseja excluir este participante?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Nenhum participante encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $participants->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
