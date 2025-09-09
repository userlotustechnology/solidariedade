@extends('layouts.sidebar')

@section('page-title', 'Dashboard Administrativo')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-tachometer-alt"></i> Dashboard Administrativo</h2>
                <span class="badge bg-primary fs-6">Administrador</span>
            </div>
        </div>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total de Participantes</h6>
                            <h3 class="mb-0">{{ $totalParticipants }}</h3>
                            <small>{{ $activeParticipants }} ativos</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Entregas Realizadas</h6>
                            <h3 class="mb-0">{{ $completedDeliveries }}</h3>
                            <small>{{ $thisMonthDeliveries }} este mês</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-truck fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Próximas Entregas</h6>
                            <h3 class="mb-0">{{ $upcomingDeliveries }}</h3>
                            <small>Agendadas</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Usuários do Sistema</h6>
                            <h3 class="mb-0">{{ $totalUsers }}</h3>
                            <small>Total cadastrados</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-cog fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Próxima Entrega -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Próxima Entrega</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="text-primary">{{ $nextDelivery['title'] }}</h4>
                            <p class="mb-1"><strong>Data:</strong> {{ $nextDelivery['formatted_date'] }}</p>
                            <p class="mb-0">
                                @if($nextDelivery['days_until'] > 0)
                                    <span class="badge bg-warning">Faltam {{ $nextDelivery['days_until'] }} dias</span>
                                @elseif($nextDelivery['days_until'] == 0)
                                    <span class="badge bg-success">É hoje!</span>
                                @else
                                    <span class="badge bg-danger">{{ abs($nextDelivery['days_until']) }} dias atrás</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            @if(auth()->user()->hasPermission('deliveries.create'))
                                <a href="{{ route('deliveries.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Criar Entrega
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráfico de Estatísticas -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Estatísticas dos Últimos 6 Meses</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Participantes por Estado -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Participantes por Estado</h5>
                </div>
                <div class="card-body">
                    @foreach($participantsByState as $state)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $state->state }}</span>
                            <span class="badge bg-secondary">{{ $state->count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Participantes e Entregas Recentes -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user-plus"></i> Participantes Recentes</h5>
                </div>
                <div class="card-body">
                    @forelse($recentParticipants as $participant)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <strong>{{ $participant->name }}</strong><br>
                                <small class="text-muted">{{ $participant->formatted_document }}</small>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">{{ $participant->created_at->diffForHumans() }}</small><br>
                                <small>por {{ $participant->registeredBy->name }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum participante recente</p>
                    @endforelse

                    @if(auth()->user()->hasPermission('participants.view'))
                        <div class="text-center mt-3">
                            <a href="{{ route('participants.index') }}" class="btn btn-outline-primary btn-sm">
                                Ver Todos os Participantes
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-truck"></i> Entregas Recentes</h5>
                </div>
                <div class="card-body">
                    @forelse($recentDeliveries as $delivery)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <strong>{{ $delivery->title }}</strong><br>
                                <small class="text-muted">{{ $delivery->delivery_date->format('d/m/Y') }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $delivery->status === 'completed' ? 'success' : ($delivery->status === 'in_progress' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($delivery->status) }}
                                </span><br>
                                <small>{{ $delivery->delivered_baskets }}/{{ $delivery->total_baskets }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Nenhuma entrega recente</p>
                    @endforelse

                    @if(auth()->user()->hasPermission('deliveries.view'))
                        <div class="text-center mt-3">
                            <a href="{{ route('deliveries.index') }}" class="btn btn-outline-success btn-sm">
                                Ver Todas as Entregas
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = @json($monthlyStats);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [{
                label: 'Novos Participantes',
                data: monthlyData.map(item => item.participants),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                yAxisID: 'y'
            }, {
                label: 'Entregas Realizadas',
                data: monthlyData.map(item => item.deliveries),
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.1,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false,
                    },
                }
            }
        }
    });
});
</script>
@endpush
