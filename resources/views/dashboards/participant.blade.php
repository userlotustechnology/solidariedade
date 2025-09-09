@extends('layouts.sidebar')

@section('page-title', 'Meu Painel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-heart"></i> Bem-vindo ao Portal Solidariedade</h2>
                <span class="badge bg-info fs-6">Participante</span>
            </div>
        </div>
    </div>

    <!-- Próxima Entrega - Destaque -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-primary bg-light">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Próxima Entrega de Cestas Básicas</h4>
                </div>
                <div class="card-body text-center">
                    <h3 class="text-primary mb-3">{{ $nextDelivery['title'] }}</h3>
                    <h5 class="mb-3">{{ $nextDelivery['formatted_date'] }}</h5>

                    @if($nextDelivery['days_until'] > 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-clock"></i>
                            <strong>Faltam {{ $nextDelivery['days_until'] }} {{ $nextDelivery['days_until'] == 1 ? 'dia' : 'dias' }}</strong>
                        </div>
                    @elseif($nextDelivery['days_until'] == 0)
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <strong>A entrega é hoje!</strong> Não se esqueça do seu documento.
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            A última entrega foi há {{ abs($nextDelivery['days_until']) }} {{ abs($nextDelivery['days_until']) == 1 ? 'dia' : 'dias' }}
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-3">
                            <div class="card bg-white border-info">
                                <div class="card-body">
                                    <h6 class="text-info"><i class="fas fa-exclamation-triangle"></i> Lembre-se:</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-id-card text-primary"></i> Traga seu documento original</li>
                                        <li><i class="fas fa-clock text-primary"></i> Horário: 8:00 às 17:00</li>
                                        <li><i class="fas fa-map-marker-alt text-primary"></i> Local será informado por telefone</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estatísticas Pessoais -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-basket fa-3x mb-3"></i>
                    <h3>{{ $totalReceived }}</h3>
                    <h6>Cestas Recebidas (Total)</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-year fa-3x mb-3"></i>
                    <h3>{{ $thisYearReceived }}</h3>
                    <h6>Cestas Recebidas em {{ now()->year }}</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Histórico de Entregas -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Histórico de Entregas</h5>
                </div>
                <div class="card-body">
                    @if($lastDeliveries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Data da Entrega</th>
                                        <th>Título</th>
                                        <th>Data do Recebimento</th>
                                        <th>Entregue por</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lastDeliveries as $record)
                                        <tr>
                                            <td>{{ $record->delivery->delivery_date->format('d/m/Y') }}</td>
                                            <td>{{ $record->delivery->title }}</td>
                                            <td>{{ $record->delivered_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $record->deliveredBy->name }}</td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Recebida
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Nenhuma entrega registrada ainda</h5>
                            <p class="text-muted">Quando você receber suas primeiras cestas, o histórico aparecerá aqui.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Informações e Contato -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informações Importantes</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-calendar text-primary"></i>
                            <strong>Entregas mensais:</strong> Sempre no último sábado do mês
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock text-primary"></i>
                            <strong>Horário:</strong> Das 8:00 às 17:00
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-id-card text-primary"></i>
                            <strong>Documento:</strong> Obrigatório apresentar documento original
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone text-primary"></i>
                            <strong>Local:</strong> Será informado por telefone ou WhatsApp
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-phone"></i> Precisa de Ajuda?</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">Entre em contato conosco:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-phone text-success"></i>
                            <strong>Telefone:</strong> (11) 9999-9999
                        </li>
                        <li class="mb-2">
                            <i class="fab fa-whatsapp text-success"></i>
                            <strong>WhatsApp:</strong> (11) 9999-9999
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope text-success"></i>
                            <strong>E-mail:</strong> contato@solidariedade.org
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock text-success"></i>
                            <strong>Horário:</strong> Segunda a Sexta, 8h às 18h
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensagem de Agradecimento -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h4><i class="fas fa-heart"></i> Obrigado por fazer parte da nossa comunidade!</h4>
                    <p class="mb-0">Juntos construímos uma sociedade mais solidária e justa para todos.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>
@endpush
