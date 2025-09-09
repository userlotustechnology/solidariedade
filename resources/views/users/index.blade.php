@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item active" aria-current="page">Usuários</li>
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
                            <h4 class="card-title mb-0">Usuários da Plataforma</h4>
                            <p class="text-muted">Gerencie todos os usuários cadastrados</p>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="btn-group">
                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                    <i class="ti-plus btn-icon-prepend"></i> Novo Usuário
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filterStatus">Status</label>
                                <select class="form-control" id="filterStatus">
                                    <option value="">Todos</option>
                                    <option value="ativo">Ativos</option>
                                    <option value="inativo">Inativos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="searchInput">Pesquisar</label>
                                <input type="text" class="form-control" id="searchInput" placeholder="Nome ou email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="users-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Data Criação</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                             style="width: 40px; height: 40px;">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ti-email text-muted me-1"></i>
                                                        {{ $user->email }}
                                                        @if($user->email_verified_at)
                                                            <i class="ti-check text-success ms-1" title="Email verificado"></i>
                                                        @else
                                                            <i class="ti-close text-danger ms-1" title="Email não verificado"></i>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('users.show', $user) }}"
                                                           class="btn btn-outline-primary btn-sm"
                                                           title="Visualizar">
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="{{ route('users.edit', $user) }}"
                                                           class="btn btn-outline-warning btn-sm"
                                                           title="Editar">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('users.destroy', $user) }}"
                                                              method="POST"
                                                              style="display: inline;"
                                                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Paginação -->
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inicializar DataTable se não estiver usando paginação do Laravel
    if ($('#users-listing tbody tr').length > 10) {
        var table = $('#users-listing').DataTable({
            "pageLength": 10,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            }
        });

        // Filtro por status
        $('#filterStatus').on('change', function() {
            const status = $(this).val();
            table.column(3).search(status).draw();
        });

        // Pesquisa geral
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    }
});
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
