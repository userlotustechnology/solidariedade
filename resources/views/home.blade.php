@extends('layouts.app')

@section('title', 'Dashboard Administrativo')

@section('content')
<div class="container-fluid">
    <!-- Cabeçalho Principal -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="ti-dashboard me-3"></i>Dashboard
                            </h1>
                            <p class="fs-5 mb-0 opacity-75">Visão geral da plataforma</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos e Estatísticas Avançadas -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-bar-chart me-2"></i>Entregas por Mês
                        </h5>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="ti-settings me-1"></i>Opções
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="ti-download me-1"></i>Exportar</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ti-printer me-1"></i>Imprimir</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 400px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-primary fw-bold mb-0">
                        <i class="ti-pie-chart me-2"></i>Status das Entregas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-pie text-center" style="height: 300px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                <span class="text-muted">Concluídas</span>
                            </div>
                            <span class="fw-semibold">{{ $completedDeliveries ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="bg-info rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                <span class="text-muted">Em Andamento</span>
                            </div>
                            <span class="fw-semibold">{{ $inProgressDeliveries ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                <span class="text-muted">Agendadas</span>
                            </div>
                            <span class="fw-semibold">{{ $scheduledDeliveries ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                <span class="text-muted">Canceladas</span>
                            </div>
                            <span class="fw-semibold">{{ $cancelledDeliveries ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Listas Recentes e Atividades -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-user me-2"></i>Participantes Recentes
                        </h5>
                        <a href="{{ route('participants.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="ti-eye me-1"></i>Ver Todos
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($recentParticipants) && $recentParticipants->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentParticipants as $participant)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                <i class="ti-user text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">{{ $participant->name }}</h6>
                                            <small class="text-muted">
                                                <i class="ti-calendar me-1"></i>
                                                Cadastrado em {{ $participant->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                        <div>
                                            <span class="badge bg-success">
                                                <i class="ti-check me-1"></i>Ativo
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="ti-user text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                            <h6 class="text-muted">Nenhum participante cadastrado ainda</h6>
                            <p class="text-muted small mb-3">Comece cadastrando os primeiros participantes do programa.</p>
                            <a href="{{ route('participants.create') }}" class="btn btn-primary btn-sm">
                                <i class="ti-plus me-1"></i>Cadastrar Participante
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-truck me-2"></i>Entregas Recentes
                        </h5>
                        <a href="{{ route('deliveries.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="ti-eye me-1"></i>Ver Todas
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($recentDeliveries) && $recentDeliveries->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentDeliveries as $delivery)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                <i class="ti-truck text-success"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">{{ $delivery->title }}</h6>
                                            <small class="text-muted">
                                                <i class="ti-calendar me-1"></i>
                                                {{ $delivery->delivery_date->format('d/m/Y') }}
                                            </small>
                                        </div>
                                        <div>
                                            @switch($delivery->status)
                                                @case('completed')
                                                    <span class="badge bg-success">
                                                        <i class="ti-check me-1"></i>Concluída
                                                    </span>
                                                    @break
                                                @case('in_progress')
                                                    <span class="badge bg-info">
                                                        <i class="ti-reload me-1"></i>Em Andamento
                                                    </span>
                                                    @break
                                                @case('scheduled')
                                                    <span class="badge bg-warning">
                                                        <i class="ti-clock me-1"></i>Agendada
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">
                                                        <i class="ti-calendar me-1"></i>Pendente
                                                    </span>
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="ti-truck text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                            <h6 class="text-muted">Nenhuma entrega cadastrada ainda</h6>
                            <p class="text-muted small mb-3">Organize a primeira entrega para os participantes.</p>
                            <a href="{{ route('deliveries.create') }}" class="btn btn-primary btn-sm">
                                <i class="ti-plus me-1"></i>Cadastrar Entrega
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
        transform: translateY(-3px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.12) !important;
    }

    .list-group-item {
        transition: all 0.2s ease;
        border-radius: 8px !important;
        margin-bottom: 8px;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .list-group-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .chart-area, .chart-pie {
        position: relative;
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .bg-opacity-25 {
        --bs-bg-opacity: 0.25;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .opacity-10 {
        opacity: 0.1 !important;
    }

    .opacity-25 {
        opacity: 0.25 !important;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .border-end {
        border-right: 1px solid #dee2e6 !important;
    }

    .card-header {
        background: none !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .btn {
        transition: all 0.2s ease;
        border-radius: 8px !important;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .badge {
        font-weight: 500 !important;
        border-radius: 6px !important;
    }

    /* Gradientes personalizados */
    .gradient-primary {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-success {
        background: linear-gradient(45deg, #11998e 0%, #38ef7d 100%);
    }

    .gradient-info {
        background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
    }

    .gradient-warning {
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
    }

    /* Animações de loading */
    .card-loading {
        position: relative;
        overflow: hidden;
    }

    .card-loading::before {
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

    /* Responsividade melhorada */
    @media (max-width: 768px) {
        .display-6 {
            font-size: 1.75rem !important;
        }

        .card-body h2 {
            font-size: 1.5rem !important;
        }

        .btn {
            font-size: 0.875rem !important;
        }
    }

    /* Estados de hover melhorados */
    .card-body:hover .opacity-10 {
        opacity: 0.15 !important;
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    /* Cores personalizadas */
    .text-primary-custom {
        color: #667eea !important;
    }

    .bg-primary-custom {
        background-color: #667eea !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuração padrão do Chart.js
        Chart.defaults.font.family = "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif";
        Chart.defaults.color = '#6c757d';

        // Dados de exemplo para demonstração
        const monthlyData = {!! json_encode($monthlyDeliveries ?? [
            ['month' => 'Jan', 'count' => 5],
            ['month' => 'Fev', 'count' => 8],
            ['month' => 'Mar', 'count' => 12],
            ['month' => 'Abr', 'count' => 7],
            ['month' => 'Mai', 'count' => 15],
            ['month' => 'Jun', 'count' => 10]
        ]) !!};

        // Gráfico de entregas mensais
        const monthlyCtx = document.getElementById('monthlyChart');
        if (monthlyCtx) {
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: monthlyData.map(item => item.month),
                    datasets: [{
                        label: 'Entregas',
                        data: monthlyData.map(item => item.count),
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 10,
                        pointHoverBackgroundColor: '#667eea',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#667eea',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false,
                            padding: 12
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d',
                                font: {
                                    weight: '500'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                borderDash: [5, 5]
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d',
                                font: {
                                    weight: '500'
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        // Gráfico de status das entregas
        const statusCtx = document.getElementById('statusChart');
        if (statusCtx) {
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Agendadas', 'Em Andamento', 'Concluídas', 'Canceladas'],
                    datasets: [{
                        data: [
                            {{ $scheduledDeliveries ?? 2 }},
                            {{ $inProgressDeliveries ?? 1 }},
                            {{ $completedDeliveries ?? 5 }},
                            {{ $cancelledDeliveries ?? 0 }}
                        ],
                        backgroundColor: [
                            '#ffc107',
                            '#17a2b8',
                            '#28a745',
                            '#dc3545'
                        ],
                        borderWidth: 0,
                        cutout: '65%',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            cornerRadius: 8,
                            displayColors: true,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                    return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Animação de entrada dos cards
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Efeito de contagem animada nos números
        const animateNumbers = () => {
            const numbers = document.querySelectorAll('h2.fw-bold');
            numbers.forEach(number => {
                const finalValue = parseInt(number.textContent.replace(/[^\d]/g, ''));
                if (finalValue > 0) {
                    let currentValue = 0;
                    const increment = finalValue / 50;
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= finalValue) {
                            number.textContent = finalValue;
                            clearInterval(timer);
                        } else {
                            number.textContent = Math.floor(currentValue);
                        }
                    }, 20);
                }
            });
        };

        // Executar animação de números após 500ms
        setTimeout(animateNumbers, 500);

        // Adicionar efeito de parallax sutil no cabeçalho
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const header = document.querySelector('.card[style*="linear-gradient(135deg"]');
            if (header) {
                header.style.transform = `translateY(${scrolled * 0.1}px)`;
            }
        });
    });
</script>
@endpush
