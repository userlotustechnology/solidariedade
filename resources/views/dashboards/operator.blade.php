@extends('layouts.sidebar')

@section('page-title', 'Dashboard Operacional')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-clipboard-list"></i> Dashboard Operacional</h2>
                <span class="badge bg-success fs-6">Operador</span>
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
                            <h6 class="card-title">Participantes Ativos</h6>
                            <h3 class="mb-0">{{ $totalParticipants }}</h3>
                            <small>Cadastrados</small>
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
                            <h6 class="card-title">Entregas Hoje</h6>
                            <h3 class="mb-0">{{ $todayDeliveries }}</h3>
                            <small>Cestas entregues</small>
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
                            <h6 class="card-title">Entregas Este Mês</h6>
                            <h3 class="mb-0">{{ $monthlyDeliveries }}</h3>
                            <small>Total do mês</small>
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
                            <h6 class="card-title">Próximas Entregas</h6>
                            <h3 class="mb-0">{{ $upcomingDeliveries }}</h3>
                            <small>Agendadas</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Entrega Ativa -->
        @if($activeDelivery)
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-play"></i> Entrega em Andamento</h5>
                </div>
                <div class="card-body">
                    <h4 class="text-success">{{ $activeDelivery->title }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Data:</strong> {{ $activeDelivery->delivery_date->format('d/m/Y') }}</p>
                            <p><strong>Horário:</strong> {{ $activeDelivery->start_time->format('H:i') }} às {{ $activeDelivery->end_time->format('H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" style="width: {{ $activeDelivery->delivery_percentage }}%"></div>
                            </div>
                            <p class="mb-0">
                                <strong>{{ $activeDelivery->delivered_baskets }}/{{ $activeDelivery->total_baskets }}</strong> cestas entregues
                                ({{ $activeDelivery->delivery_percentage }}%)
                            </p>
                        </div>
                    </div>
                    <div class="mt-3">
                        @if(auth()->user()->hasPermission('deliveries.edit'))
                            <a href="{{ route('deliveries.show', $activeDelivery) }}" class="btn btn-success">
                                <i class="fas fa-eye"></i> Gerenciar Entrega
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Próxima Entrega -->
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Próxima Entrega</h5>
                </div>
                <div class="card-body">
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
            </div>
        </div>
        @endif

        <!-- Estatísticas Semanais -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Últimas 4 Semanas</h5>
                </div>
                <div class="card-body">
                    @foreach($weeklyStats as $week)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small>{{ $week['week'] }}</small>
                            <span class="badge bg-primary">{{ $week['deliveries'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(auth()->user()->hasPermission('participants.create'))
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('participants.create') }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-user-plus fa-2x d-block mb-2"></i>
                                    Cadastrar Participante
                                </a>
                            </div>
                        @endif

                        @if(auth()->user()->hasPermission('participants.view'))
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('participants.index') }}" class="btn btn-outline-info w-100">
                                    <i class="fas fa-list fa-2x d-block mb-2"></i>
                                    Listar Participantes
                                </a>
                            </div>
                        @endif

                        @if(auth()->user()->hasPermission('deliveries.create'))
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('deliveries.create') }}" class="btn btn-outline-success w-100">
                                    <i class="fas fa-truck fa-2x d-block mb-2"></i>
                                    Nova Entrega
                                </a>
                            </div>
                        @endif

                        @if(auth()->user()->hasPermission('deliveries.view'))
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('deliveries.index') }}" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-calendar fa-2x d-block mb-2"></i>
                                    Agenda de Entregas
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Participantes Recentes -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user-plus"></i> Participantes Cadastrados Recentemente</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Documento</th>
                                    <th>Telefone</th>
                                    <th>Família</th>
                                    <th>Cadastrado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentParticipants as $participant)
                                    <tr>
                                        <td>{{ $participant->name }}</td>
                                        <td>
                                            <small class="text-muted">{{ $participant->document_type }}</small><br>
                                            {{ $participant->formatted_document }}
                                        </td>
                                        <td>{{ $participant->phone ?: '-' }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $participant->family_members }}
                                                {{ $participant->family_members == 1 ? 'pessoa' : 'pessoas' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $participant->created_at->diffForHumans() }}<br>
                                            <small class="text-muted">por {{ $participant->registeredBy->name }}</small>
                                        </td>
                                        <td>
                                            @if(auth()->user()->hasPermission('participants.view'))
                                                <a href="{{ route('participants.show', $participant) }}"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Nenhum participante recente</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
