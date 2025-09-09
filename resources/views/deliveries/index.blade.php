@extends('layouts.app')

@section('title', 'Gerenciamento de Entregas')

@section('content')
<div class="container-fluid">
    <!-- Cabeçalho Principal -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="card-body text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="ti-truck me-3"></i>Gerenciamento de Entregas
                            </h1>
                            <p class="fs-5 mb-0 opacity-75">Organize e acompanhe todas as distribuições</p>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('deliveries.create') }}" class="btn btn-light btn-lg">
                                <i class="ti-plus me-2"></i>Nova Entrega
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="ti-check-circle me-2" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Sucesso!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="ti-exclamation-triangle me-2" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Erro!</strong> {{ session('error') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Estatísticas Rápidas -->
    @php
        $totalDeliveries = $deliveries->total();
        $scheduledCount = $deliveries->where('status', 'scheduled')->count();
        $inProgressCount = $deliveries->where('status', 'in_progress')->count();
        $completedCount = $deliveries->where('status', 'completed')->count();
        $cancelledCount = $deliveries->where('status', 'cancelled')->count();
    @endphp

    <div class="row mb-4">
        <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-white-50 fw-semibold mb-1">TOTAL DE ENTREGAS</div>
                            <h2 class="fw-bold mb-0">{{ $totalDeliveries }}</h2>
                            <div class="mt-2">
                                <small class="text-white-50">
                                    <i class="ti-truck me-1"></i>Todas as entregas
                                </small>
                            </div>
                        </div>
                        <div class="opacity-25">
                            <i class="ti-package" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #ffc107 0%, #ff8a00 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-white-50 fw-semibold mb-1">AGENDADAS</div>
                            <h2 class="fw-bold mb-0">{{ $scheduledCount }}</h2>
                            <div class="mt-2">
                                <small class="text-white-50">
                                    <i class="ti-clock me-1"></i>Aguardando execução
                                </small>
                            </div>
                        </div>
                        <div class="opacity-25">
                            <i class="ti-calendar" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #17a2b8 0%, #20c997 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-white-50 fw-semibold mb-1">EM ANDAMENTO</div>
                            <h2 class="fw-bold mb-0">{{ $inProgressCount }}</h2>
                            <div class="mt-2">
                                <small class="text-white-50">
                                    <i class="ti-reload me-1"></i>Sendo executadas
                                </small>
                            </div>
                        </div>
                        <div class="opacity-25">
                            <i class="ti-reload" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #28a745 0%, #20c997 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-white-50 fw-semibold mb-1">CONCLUÍDAS</div>
                            <h2 class="fw-bold mb-0">{{ $completedCount }}</h2>
                            <div class="mt-2">
                                <small class="text-white-50">
                                    <i class="ti-check me-1"></i>Finalizadas
                                </small>
                            </div>
                        </div>
                        <div class="opacity-25">
                            <i class="ti-check" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros e Pesquisa -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-primary fw-bold mb-0">
                        <i class="ti-filter me-2"></i>Filtros e Pesquisa
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="filterStatus" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="filterStatus">
                                <option value="">Todos os status</option>
                                <option value="scheduled">Agendadas</option>
                                <option value="in_progress">Em Andamento</option>
                                <option value="completed">Concluídas</option>
                                <option value="cancelled">Canceladas</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="filterDate" class="form-label fw-semibold">Data</label>
                            <input type="date" class="form-control" id="filterDate">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="searchInput" class="form-label fw-semibold">Pesquisar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ti-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchInput"
                                       placeholder="Título ou descrição da entrega">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="d-grid" style="margin-top: 32px;">
                                <button class="btn btn-outline-secondary" id="clearFilters">
                                    <i class="ti-refresh me-1"></i>Limpar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Entregas -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-primary fw-bold mb-0">
                        <i class="ti-list me-2"></i>Lista de Entregas
                        <span class="badge bg-primary ms-2">{{ $totalDeliveries }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($deliveries->count() > 0)
                        <div class="table-responsive">
                            <table id="deliveries-listing" class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 py-3 ps-4">
                                            <div class="fw-semibold text-dark">Entrega</div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="fw-semibold text-dark">Data</div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="fw-semibold text-dark">Status</div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="fw-semibold text-dark">Participantes</div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="fw-semibold text-dark">Progresso</div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="fw-semibold text-dark">Pendentes</div>
                                        </th>
                                        <th class="border-0 py-3 text-center pe-4">
                                            <div class="fw-semibold text-dark">Ações</div>
                                        </th>
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
                                        <tr class="align-middle">
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                        <i class="ti-truck text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1 fw-bold">{{ $delivery->title }}</h6>
                                                        @if($delivery->description)
                                                            <small class="text-muted">{{ Str::limit($delivery->description, 60) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="fw-semibold">{{ $delivery->delivery_date->format('d/m/Y') }}</div>
                                                        <small class="text-muted">{{ $delivery->delivery_date->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                @switch($delivery->status)
                                                    @case('scheduled')
                                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">
                                                            <i class="ti-clock me-1"></i>Agendada
                                                        </span>
                                                        @break
                                                    @case('in_progress')
                                                        <span class="badge bg-info bg-opacity-10 text-info border border-info">
                                                            <i class="ti-reload me-1"></i>Em Andamento
                                                        </span>
                                                        @break
                                                    @case('completed')
                                                        <span class="badge bg-success bg-opacity-10 text-success border border-success">
                                                            <i class="ti-check me-1"></i>Concluída
                                                        </span>
                                                        @break
                                                    @case('cancelled')
                                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">
                                                            <i class="ti-close me-1"></i>Cancelada
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-1 me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <span class="fw-semibold text-secondary">{{ $totalParticipants }}</span>
                                                    </div>
                                                    <small class="text-muted">participantes</small>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3" style="width: 100px;">
                                                        <div class="progress" style="height: 8px;">
                                                            <div class="progress-bar bg-success"
                                                                 style="width: {{ $progressPercentage }}%"
                                                                 aria-valuenow="{{ $progressPercentage }}"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="fw-semibold text-success">{{ $deliveredCount }}</div>
                                                        <small class="text-muted">{{ $progressPercentage }}%</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                @if($pendingCount > 0)
                                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">
                                                        <i class="ti-clock me-1"></i>{{ $pendingCount }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success">
                                                        <i class="ti-check me-1"></i>0
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 text-center pe-4">
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
                                                        <button type="button"
                                                                class="btn btn-outline-danger btn-sm"
                                                                title="Excluir"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $delivery->id }}">
                                                            <i class="ti-trash"></i>
                                                        </button>

                                                        <!-- Modal de Confirmação -->
                                                        <div class="modal fade" id="deleteModal{{ $delivery->id }}" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content border-0 shadow">
                                                                    <div class="modal-header border-0 pb-0">
                                                                        <h5 class="modal-title text-danger">
                                                                            <i class="ti-exclamation-triangle me-2"></i>Confirmar Exclusão
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="mb-1">Tem certeza que deseja excluir a entrega:</p>
                                                                        <p class="fw-bold text-primary">{{ $delivery->title }}</p>
                                                                        <p class="text-muted small mb-0">Esta ação não pode ser desfeita.</p>
                                                                    </div>
                                                                    <div class="modal-footer border-0 pt-0">
                                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                            <i class="ti-close me-1"></i>Cancelar
                                                                        </button>
                                                                        <form action="{{ route('deliveries.destroy', $delivery) }}"
                                                                              method="POST" style="display: inline;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger">
                                                                                <i class="ti-trash me-1"></i>Excluir
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginação -->
                        @if($deliveries->hasPages())
                            <div class="d-flex justify-content-center py-4">
                                {{ $deliveries->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="ti-package text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                            </div>
                            <h5 class="text-muted mb-2">Nenhuma entrega cadastrada</h5>
                            <p class="text-muted mb-4">Comece criando sua primeira entrega para começar as distribuições.</p>
                            <a href="{{ route('deliveries.create') }}" class="btn btn-primary btn-lg">
                                <i class="ti-plus me-2"></i>Criar Primeira Entrega
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient {
        background-size: 200% 200%;
        animation: gradientShift 4s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .card {
        transition: all 0.3s ease;
        border: none !important;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.03);
        transform: scale(1.002);
        transition: all 0.2s ease;
    }

    .btn {
        transition: all 0.2s ease;
        border-radius: 6px !important;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .badge {
        font-weight: 500 !important;
        border-radius: 6px !important;
        padding: 0.5em 0.8em !important;
    }

    .progress {
        border-radius: 10px !important;
        background-color: rgba(0, 0, 0, 0.05) !important;
    }

    .progress-bar {
        border-radius: 10px !important;
        background: linear-gradient(45deg, #28a745, #20c997) !important;
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .opacity-10 {
        opacity: 0.1 !important;
    }

    .opacity-25 {
        opacity: 0.25 !important;
    }

    .card-header {
        background: none !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .table th {
        font-weight: 600 !important;
        color: #495057 !important;
        background-color: #f8f9fa !important;
    }

    .modal-content {
        border-radius: 12px !important;
    }

    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    /* Animações de hover melhoradas */
    .card-body:hover .opacity-10 {
        opacity: 0.15 !important;
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    /* Estados de foco melhorados */
    .form-control:focus, .form-select:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .display-6 {
            font-size: 1.75rem !important;
        }

        .card-body h2 {
            font-size: 1.5rem !important;
        }

        .btn-group {
            flex-direction: column;
        }

        .btn-group .btn {
            border-radius: 6px !important;
            margin-bottom: 2px;
        }
    }

    /* Animação de loading para a tabela */
    .table-loading {
        position: relative;
        overflow: hidden;
    }

    .table-loading::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    /* Melhorias no visual dos alerts */
    .alert {
        border-radius: 10px !important;
        border: none !important;
    }

    .alert-success {
        background: linear-gradient(45deg, rgba(40, 167, 69, 0.1), rgba(32, 201, 151, 0.1)) !important;
        color: #155724 !important;
    }

    .alert-danger {
        background: linear-gradient(45deg, rgba(220, 53, 69, 0.1), rgba(255, 99, 132, 0.1)) !important;
        color: #721c24 !important;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Inicializar DataTable se houver dados
    if ($('#deliveries-listing tbody tr').length > 0) {
        var table = $('#deliveries-listing').DataTable({
            "pageLength": 10,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "dom": 'rtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json",
                "paginate": {
                    "previous": "<i class='ti-chevron-left'></i>",
                    "next": "<i class='ti-chevron-right'></i>"
                }
            },
            "columnDefs": [
                { "orderable": false, "targets": 6 } // Desabilitar ordenação na coluna de ações
            ]
        });

        // Filtro por status
        $('#filterStatus').on('change', function() {
            const status = $(this).val();
            if (status) {
                table.column(2).search(status, false, false).draw();
            } else {
                table.column(2).search('').draw();
            }
        });

        // Filtro por data
        $('#filterDate').on('change', function() {
            const date = $(this).val();
            if (date) {
                // Converter formato para pesquisa
                const dateParts = date.split('-');
                const searchDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];
                table.column(1).search(searchDate, false, false).draw();
            } else {
                table.column(1).search('').draw();
            }
        });

        // Pesquisa geral
        $('#searchInput').on('keyup', function() {
            table.column(0).search(this.value).draw();
        });

        // Limpar filtros
        $('#clearFilters').on('click', function() {
            $('#filterStatus').val('');
            $('#filterDate').val('');
            $('#searchInput').val('');
            table.search('').columns().search('').draw();
        });
    }

    // Animação de entrada dos cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Efeito de contagem animada nos números dos cards
    const animateNumbers = () => {
        const numbers = document.querySelectorAll('h2.fw-bold');
        numbers.forEach(number => {
            const finalValue = parseInt(number.textContent.replace(/[^\d]/g, ''));
            if (finalValue > 0) {
                let currentValue = 0;
                const increment = finalValue / 30;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        number.textContent = finalValue;
                        clearInterval(timer);
                    } else {
                        number.textContent = Math.floor(currentValue);
                    }
                }, 30);
            }
        });
    };

    // Executar animação de números após 300ms
    setTimeout(animateNumbers, 300);

    // Melhorar UX dos modais
    $('.modal').on('show.bs.modal', function() {
        $('body').addClass('modal-open');
    });

    $('.modal').on('hidden.bs.modal', function() {
        $('body').removeClass('modal-open');
    });

    // Tooltip para botões
    $('[title]').tooltip({
        placement: 'top',
        trigger: 'hover'
    });

    // Efeito de loading nas ações
    $('.btn-group .btn').on('click', function() {
        if (!$(this).hasClass('btn-outline-danger')) {
            const originalText = $(this).html();
            $(this).html('<i class="ti-reload ti-spin"></i>');

            setTimeout(() => {
                $(this).html(originalText);
            }, 1000);
        }
    });

    // Auto-refresh da página a cada 5 minutos para atualizações
    let autoRefreshTimer = setTimeout(function() {
        if (confirm('Dados podem ter sido atualizados. Deseja recarregar a página?')) {
            location.reload();
        }
    }, 300000); // 5 minutos

    // Cancelar auto-refresh se o usuário interagir com filtros
    $('#filterStatus, #filterDate, #searchInput').on('change keyup', function() {
        clearTimeout(autoRefreshTimer);
    });
});

// Função para adicionar classe CSS de loading
function addLoadingEffect(element) {
    element.classList.add('table-loading');
    setTimeout(() => {
        element.classList.remove('table-loading');
    }, 1000);
}

// Adicionar efeito de parallax sutil no cabeçalho
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const header = document.querySelector('.card[style*="linear-gradient(135deg"]');
    if (header) {
        header.style.transform = `translateY(${scrolled * 0.1}px)`;
    }
});
</script>
@endpush
