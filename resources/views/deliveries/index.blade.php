@extends('layouts.sidebar-simple')

@section('page-title', 'Gerenciar Entregas')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-truck"></i> Entregas
                    </h5>
                    <a href="{{ route('deliveries.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nova Entrega
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($deliveries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Título</th>
                                        <th>Data de Entrega</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Entregues</th>
                                        <th>Pendentes</th>
                                        <th width="150">Ações</th>
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
                                                <strong>{{ $delivery->title }}</strong>
                                                @if($delivery->description)
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($delivery->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar"></i>
                                                {{ $delivery->delivery_date->format('d/m/Y') }}
                                                <br>
                                                <small class="text-muted">{{ $delivery->delivery_date->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                @switch($delivery->status)
                                                    @case('scheduled')
                                                        <span class="badge bg-primary">
                                                            <i class="fas fa-clock"></i> Agendada
                                                        </span>
                                                        @break
                                                    @case('in_progress')
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-truck"></i> Em Andamento
                                                        </span>
                                                        @break
                                                    @case('completed')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check"></i> Concluída
                                                        </span>
                                                        @break
                                                    @case('cancelled')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times"></i> Cancelada
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $totalParticipants }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $deliveredCount }}</span>
                                                @if($progressPercentage > 0)
                                                    <div class="progress mt-1" style="height: 5px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                             style="width: {{ $progressPercentage }}%"
                                                             aria-valuenow="{{ $progressPercentage }}"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($pendingCount > 0)
                                                    <span class="badge bg-warning">{{ $pendingCount }}</span>
                                                @else
                                                    <span class="badge bg-light text-dark">0</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('deliveries.show', $delivery) }}"
                                                       class="btn btn-sm btn-info"
                                                       title="Gerenciar Participantes">
                                                        <i class="fas fa-users"></i>
                                                    </a>

                                                    <a href="{{ route('deliveries.edit', $delivery) }}"
                                                       class="btn btn-sm btn-warning"
                                                       title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    @if($delivery->delivery_records_count == 0)
                                                        <form action="{{ route('deliveries.destroy', $delivery) }}"
                                                              method="POST"
                                                              class="d-inline"
                                                              onsubmit="return confirm('Tem certeza que deseja excluir esta entrega?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-danger"
                                                                    title="Excluir">
                                                                <i class="fas fa-trash"></i>
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

                        <!-- Paginação -->
                        <div class="d-flex justify-content-center">
                            {{ $deliveries->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-box fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Nenhuma entrega cadastrada</h5>
                            <p class="text-muted">Comece criando sua primeira entrega.</p>
                            <a href="{{ route('deliveries.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Criar Primeira Entrega
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
