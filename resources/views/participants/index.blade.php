@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item active" aria-current="page">Participantes</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="card-title mb-0">Participantes</h4>
                            <p class="text-muted">Gerencie todos os participantes cadastrados</p>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="btn-group">
                                <a href="{{ route('participants.create') }}" class="btn btn-primary">
                                    <i class="ti-plus btn-icon-prepend"></i> Novo Participante
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <form method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="search">Pesquisar</label>
                                    <input type="text" class="form-control" name="search" id="search"
                                           value="{{ request('search') }}"
                                           placeholder="Nome ou documento...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Todos</option>
                                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Ativos</option>
                                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inativos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="filter-actions">Ações</label>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="ti-search"></i> Filtrar
                                        </button>
                                        <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">
                                            <i class="ti-reload"></i> Limpar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="participants-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>ID</th>
                                            <th>Participante</th>
                                            <th>Documento</th>
                                            <th>Contato</th>
                                            <th>Família</th>
                                            <th>Status</th>
                                            <th>Cadastrado em</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($participants as $participant)
                                            <tr>
                                                <td>{{ $participant->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2"
                                                             style="width: 40px; height: 40px;">
                                                            {{ strtoupper(substr($participant->name, 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $participant->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $participant->document_type ?? 'CPF' }}</small><br>
                                                    {{ $participant->formatted_document ?? $participant->cpf ?? 'Não informado' }}
                                                </td>
                                                <td>
                                                    <div>
                                                        @if($participant->formatted_phone ?? $participant->phone)
                                                            <div class="d-flex align-items-center mb-1">
                                                                <i class="ti-mobile text-muted me-1"></i>
                                                                {{ $participant->formatted_phone ?? $participant->phone }}
                                                            </div>
                                                        @endif
                                                        @if($participant->email)
                                                            <div class="d-flex align-items-center">
                                                                <i class="ti-email text-muted me-1"></i>
                                                                {{ $participant->email }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $participant->family_members ?? 1 }}
                                                        {{ ($participant->family_members ?? 1) == 1 ? 'pessoa' : 'pessoas' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($participant->active ?? true)
                                                        <span class="badge bg-success">Ativo</span>
                                                    @else
                                                        <span class="badge bg-danger">Inativo</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ ($participant->registered_at ?? $participant->created_at)->format('d/m/Y') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('participants.show', $participant) }}"
                                                           class="btn btn-outline-primary btn-sm"
                                                           title="Visualizar">
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="{{ route('participants.edit', $participant) }}"
                                                           class="btn btn-outline-warning btn-sm"
                                                           title="Editar">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                        @if(Route::has('participants.print'))
                                                            <a href="{{ route('participants.print', $participant) }}"
                                                               class="btn btn-outline-info btn-sm"
                                                               title="Imprimir">
                                                                <i class="ti-printer"></i>
                                                            </a>
                                                        @endif
                                                        <form action="{{ route('participants.destroy', $participant) }}"
                                                              method="POST"
                                                              style="display: inline;"
                                                              onsubmit="return confirm('Tem certeza que deseja excluir este participante?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-outline-danger btn-sm"
                                                                    title="Excluir">
                                                                <i class="ti-trash"></i>
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
                        </div>
                    </div>

                    <!-- Paginação -->
                    <div class="d-flex justify-content-center">
                        {{ $participants->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
