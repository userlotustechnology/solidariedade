@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <!-- Cabeçalho da Dashboard -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-primary fw-bold mb-1">
                        <i class="ti-dashboard me-2"></i>Dashboard
                    </h2>
                    <p class="text-muted mb-0">Visão geral do sistema de solidariedade</p>
                </div>
                <div class="text-muted">
                    <i class="ti-calendar me-1"></i>{{ date('d/m/Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient" style="background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-1">TOTAL DE PARTICIPANTES</h6>
                            <h2 class="fw-bold mb-0">{{ $totalParticipants }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="ti-user text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-white-50">
                            <i class="ti-arrow-up me-1"></i>Pessoas cadastradas
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient" style="background: linear-gradient(45deg, #11998e 0%, #38ef7d 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-1">PARTICIPANTES ATIVOS</h6>
                            <h2 class="fw-bold mb-0">{{ $activeParticipants }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="ti-check text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-white-50">
                            <i class="ti-pulse me-1"></i>Participação ativa
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient" style="background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-1">TOTAL DE ENTREGAS</h6>
                            <h2 class="fw-bold mb-0">{{ $totalDeliveries }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="ti-truck text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-white-50">
                            <i class="ti-package me-1"></i>Entregas realizadas
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-gradient" style="background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-white-50 mb-1">ENTREGAS ESTE MÊS</h6>
                            <h2 class="fw-bold mb-0">{{ $thisMonthDeliveries }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="ti-calendar text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-white-50">
                            <i class="ti-trending-up me-1"></i>Mês atual
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm">
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
                    <div class="chart-area" style="height: 350px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-primary fw-bold mb-0">
                        <i class="ti-pie-chart me-2"></i>Status das Entregas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-pie" style="height: 300px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-3">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-end">
                                    <div class="text-primary fw-bold">{{ $deliveryStats['completed'] }}</div>
                                    <small class="text-muted">Concluídas</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-warning fw-bold">{{ $deliveryStats['in_progress'] }}</div>
                                <small class="text-muted">Em Andamento</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Listas Recentes -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
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
                    @if($recentParticipants->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentParticipants as $participant)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
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
                                <i class="ti-user text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
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
            <div class="card border-0 shadow-sm">
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
                    @if($recentDeliveries->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentDeliveries as $delivery)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
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
                                            @if($delivery->status === 'completed')
                                                <span class="badge bg-success">
                                                    <i class="ti-check me-1"></i>Concluída
                                                </span>
                                            @elseif($delivery->status === 'in_progress')
                                                <span class="badge bg-warning">
                                                    <i class="ti-clock me-1"></i>Em Andamento
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="ti-calendar me-1"></i>Agendada
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="ti-truck text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
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
    .bg-gradient {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .list-group-item {
        transition: background-color 0.2s ease;
    }

    .list-group-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    .chart-area, .chart-pie {
        position: relative;
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .bg-opacity-25 {
        --bs-bg-opacity: 0.25;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .border-end {
        border-right: 1px solid #dee2e6 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuração padrão do Chart.js
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#6c757d';

        // Gráfico de entregas mensais
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(collect($monthlyDeliveries)->pluck('month')) !!},
                datasets: [{
                    label: 'Entregas',
                    data: {!! json_encode(collect($monthlyDeliveries)->pluck('count')) !!},
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
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
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        border: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Gráfico de status das entregas
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Agendadas', 'Em Andamento', 'Concluídas', 'Canceladas'],
                datasets: [{
                    data: [
                        {{ $deliveryStats['scheduled'] }},
                        {{ $deliveryStats['in_progress'] }},
                        {{ $deliveryStats['completed'] }},
                        {{ $deliveryStats['cancelled'] }}
                    ],
                    backgroundColor: [
                        '#6c757d',
                        '#ffc107',
                        '#198754',
                        '#dc3545'
                    ],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });

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
    });
</script>
@endpush
