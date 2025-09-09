@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item active" aria-current="page">Entregas</li>
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
                            <h4 class="card-title mb-0">Entregas</h4>
                            <p class="text-muted">Gerencie todas as entregas e distribuições</p>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="btn-group">
                                <a href="{{ route('deliveries.create') }}" class="btn btn-primary">
                                    <i class="ti-plus btn-icon-prepend"></i> Nova Entrega
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterStatus">Status</label>
                                <select class="form-control" id="filterStatus">
                                    <option value="">Todos</option>
                                    <option value="scheduled">Agendada</option>
                                    <option value="in_progress">Em Andamento</option>
                                    <option value="completed">Concluída</option>
                                    <option value="cancelled">Cancelada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterDate">Data</label>
                                <input type="date" class="form-control" id="filterDate">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="searchInput">Pesquisar</label>
                                <input type="text" class="form-control" id="searchInput" placeholder="Título ou descrição">
                            </div>
                        </div>
                    </div>

                    @if($deliveries->count() > 0)
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="deliveries-listing" class="table">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th>Entrega</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Progresso</th>
                                                <th>Pendentes</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deliveries as $delivery)
                                                @php
                                                    $totalParticipants = $delivery->deliveryRecords->count();
                                                    $deliveredCount = $delivery->deliveryRecords->where('status', 'delivered')->count();
                                                    $pendingCount = $totalParticipants - $deliveredCount;
                                                    $progressPercentage = $totalParticipants > 0 ? round(($deliveredCount / $totalParticipants) * 100) : 0;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h6 class="mb-0">{{ $delivery->title }}</h6>
                                                            @if($delivery->description)
                                                                <small class="text-muted">{{ Str::limit($delivery->description, 50) }}</small>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="ti-calendar text-muted me-1"></i>
                                                            <div>
                                                                {{ $delivery->delivery_date->format('d/m/Y') }}
                                                                <br>
                                                                <small class="text-muted">{{ $delivery->delivery_date->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @switch($delivery->status)
                                                            @case('scheduled')
                                                                <span class="badge bg-primary">
                                                                    <i class="ti-time"></i> Agendada
                                                                </span>
                                                                @break
                                                            @case('in_progress')
                                                                <span class="badge bg-warning">
                                                                    <i class="ti-truck"></i> Em Andamento
                                                                </span>
                                                                @break
                                                            @case('completed')
                                                                <span class="badge bg-success">
                                                                    <i class="ti-check"></i> Concluída
                                                                </span>
                                                                @break
                                                            @case('cancelled')
                                                                <span class="badge bg-danger">
                                                                    <i class="ti-close"></i> Cancelada
                                                                </span>
                                                                @break
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-secondary">{{ $totalParticipants }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="badge bg-success me-2">{{ $deliveredCount }}</span>
                                                            @if($progressPercentage > 0)
                                                                <div class="progress" style="width: 80px; height: 8px;">
                                                                    <div class="progress-bar bg-success"
                                                                         style="width: {{ $progressPercentage }}%"
                                                                         aria-valuenow="{{ $progressPercentage }}"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                                <small class="ms-2 text-muted">{{ $progressPercentage }}%</small>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($pendingCount > 0)
                                                            <span class="badge bg-warning">{{ $pendingCount }}</span>
                                                        @else
                                                            <span class="badge bg-light text-dark">0</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('deliveries.show', $delivery) }}"
                                                               class="btn btn-outline-primary btn-sm"
                                                               title="Gerenciar Participantes">
                                                                <i class="ti-eye"></i>
                                                            </a>
                                                            <a href="{{ route('deliveries.edit', $delivery) }}"
                                                               class="btn btn-outline-warning btn-sm"
                                                               title="Editar">
                                                                <i class="ti-pencil"></i>
                                                            </a>
                                                            @if($delivery->delivery_records_count == 0)
                                                                <form action="{{ route('deliveries.destroy', $delivery) }}"
                                                                      method="POST"
                                                                      style="display: inline;"
                                                                      onsubmit="return confirm('Tem certeza que deseja excluir esta entrega?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            class="btn btn-outline-danger btn-sm"
                                                                            title="Excluir">
                                                                        <i class="ti-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
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
                            {{ $deliveries->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="ti-package" style="font-size: 4rem; color: #6c757d;"></i>
                            </div>
                            <h5 class="text-muted">Nenhuma entrega cadastrada</h5>
                            <p class="text-muted">Comece criando sua primeira entrega.</p>
                            <a href="{{ route('deliveries.create') }}" class="btn btn-primary">
                                <i class="ti-plus"></i> Criar Primeira Entrega
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inicializar DataTable se houver dados
    if ($('#deliveries-listing tbody tr').length > 10) {
        var table = $('#deliveries-listing').DataTable({
            "pageLength": 10,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            }
        });

        // Filtro por status
        $('#filterStatus').on('change', function() {
            const status = $(this).val();
            table.column(2).search(status).draw();
        });

        // Pesquisa geral
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    }
});
</script>
@endpush
