@extends('layouts.app')

@section('page-title', 'Gerenciar Participantes da Entrega')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $delivery->title }}</h4>
                        <small class="text-muted">
                            {{ $delivery->delivery_date->format('d/m/Y') }} -
                            @switch($delivery->status)
                                @case('scheduled')
                                    <span class="badge bg-warning">Agendada</span>
                                    @break
                                @case('in_progress')
                                    <span class="badge bg-info">Em Andamento</span>
                                    @break
                                @case('completed')
                                    <span class="badge bg-success">Concluída</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge bg-danger">Cancelada</span>
                                    @break
                            @endswitch
                        </small>
                    </div>
                    <div>
                        <a href="{{ route('deliveries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Estatísticas Rápidas -->
                    @php
                        $totalParticipants = count($participantStatuses);
                        $presentCount = collect($participantStatuses)->where('status', 'present')->count();
                        $absentCount = collect($participantStatuses)->where('status', 'absent')->count();
                        $excusedCount = collect($participantStatuses)->where('status', 'excused')->count();
                        $pendingCount = collect($participantStatuses)->where('status', 'pending')->count();
                        $progressPercentage = $totalParticipants > 0 ? (($presentCount + $absentCount + $excusedCount) / $totalParticipants) * 100 : 0;
                    @endphp

                    <div class="row mb-4">
                        <div class="col-md-2">
                            <div class="card bg-secondary text-white text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalParticipants }}</h5>
                                    <p class="card-text small">Total de Participantes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-success text-white text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $presentCount }}</h5>
                                    <p class="card-text small">Presentes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-danger text-white text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $absentCount }}</h5>
                                    <p class="card-text small">Ausentes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-warning text-white text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $excusedCount }}</h5>
                                    <p class="card-text small">Justificados</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-info text-white text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pendingCount }}</h5>
                                    <p class="card-text small">Pendentes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-primary text-white text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ number_format($progressPercentage, 1) }}%</h5>
                                    <p class="card-text small">Progresso</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="searchParticipant" class="form-control" placeholder="Buscar participante por nome...">
                        </div>
                        <div class="col-md-6">
                            <select id="filterStatus" class="form-select">
                                <option value="">Todos os status</option>
                                <option value="pending">Pendentes</option>
                                <option value="present">Presentes</option>
                                <option value="absent">Ausentes</option>
                                <option value="excused">Justificados</option>
                            </select>
                        </div>
                    </div>

                    <!-- Lista de Participantes -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="participantsTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nome</th>
                                    <th>Documento</th>
                                    <th>Telefone</th>
                                    <th>Família</th>
                                    <th>Status</th>
                                    <th>Horário</th>
                                    <th>Observações</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participantStatuses as $participantId => $data)
                                    @php
                                        $participant = $data['participant'];
                                        $record = $data['record'];
                                        $status = $data['status'];
                                    @endphp
                                    <tr data-participant-id="{{ $participantId }}" data-status="{{ $status }}">
                                        <td>
                                            <strong>{{ $participant->name }}</strong>
                                        </td>
                                        <td>
                                            {{ $participant->document_type }}: {{ $participant->formatted_document }}
                                        </td>
                                        <td>
                                            {{ $participant->phone ?: 'Não informado' }}
                                        </td>
                                        <td>
                                            {{ $participant->family_members }}
                                            {{ $participant->family_members === 1 ? 'pessoa' : 'pessoas' }}
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $status }}">
                                                @switch($status)
                                                    @case('present')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check"></i> Presente
                                                        </span>
                                                        @break
                                                    @case('absent')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times"></i> Ausente
                                                        </span>
                                                        @break
                                                    @case('excused')
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-file-medical"></i> Justificado
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">
                                                            <i class="fas fa-clock"></i> Pendente
                                                        </span>
                                                @endswitch
                                            </span>
                                        </td>
                                        <td class="delivery-time">
                                            @if($record && $record->delivered_at)
                                                {{ $record->delivered_at->format('H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="participant-notes">
                                            {{ $record->notes ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-success mark-present"
                                                        data-participant-id="{{ $participantId }}"
                                                        title="Marcar como Presente">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger mark-absent"
                                                        data-participant-id="{{ $participantId }}"
                                                        title="Marcar como Ausente">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning mark-excused"
                                                        data-participant-id="{{ $participantId }}"
                                                        title="Marcar como Justificado">
                                                    <i class="fas fa-file-medical"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Observações -->
<div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="notesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notesModalLabel">Adicionar Observação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modalParticipantId">
                <input type="hidden" id="modalStatus">
                <div class="mb-3">
                    <label for="participantName" class="form-label">Participante</label>
                    <input type="text" class="form-control" id="participantName" readonly>
                </div>
                <div class="mb-3">
                    <label for="statusText" class="form-label">Status</label>
                    <input type="text" class="form-control" id="statusText" readonly>
                </div>
                <div class="mb-3">
                    <label for="notesText" class="form-label">Observações</label>
                    <textarea class="form-control" id="notesText" rows="3" placeholder="Digite observações sobre esta marcação..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveStatus">Confirmar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .status-badge {
        min-width: 100px;
        display: inline-block;
    }

    .btn-group .btn {
        margin: 0 1px;
    }

    .table td {
        vertical-align: middle;
    }

    .card .card-body {
        padding: 0.75rem;
    }

    .card h5 {
        margin-bottom: 0.25rem;
        font-size: 1.5rem;
    }

    .card .card-text {
        margin-bottom: 0;
        font-size: 0.8rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deliveryId = {{ $delivery->id }};
    let currentParticipantId = null;
    let currentStatus = null;

    // Filtro de busca
    document.getElementById('searchParticipant').addEventListener('input', function() {
        filterTable();
    });

    // Filtro de status
    document.getElementById('filterStatus').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const searchTerm = document.getElementById('searchParticipant').value.toLowerCase();
        const statusFilter = document.getElementById('filterStatus').value;
        const rows = document.querySelectorAll('#participantsTable tbody tr');

        rows.forEach(row => {
            const name = row.querySelector('td:first-child').textContent.toLowerCase();
            const status = row.getAttribute('data-status');

            const matchesSearch = name.includes(searchTerm);
            const matchesStatus = !statusFilter || status === statusFilter;

            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }

    // Botões de ação
    document.querySelectorAll('.mark-present, .mark-absent, .mark-excused').forEach(button => {
        button.addEventListener('click', function() {
            currentParticipantId = this.getAttribute('data-participant-id');
            const row = document.querySelector(`tr[data-participant-id="${currentParticipantId}"]`);
            const participantName = row.querySelector('td:first-child strong').textContent;

            if (this.classList.contains('mark-present')) {
                currentStatus = 'present';
                document.getElementById('statusText').value = 'Presente - Recebeu a cesta';
            } else if (this.classList.contains('mark-absent')) {
                currentStatus = 'absent';
                document.getElementById('statusText').value = 'Ausente - Não compareceu';
            } else if (this.classList.contains('mark-excused')) {
                currentStatus = 'excused';
                document.getElementById('statusText').value = 'Justificado - Ausência com atestado';
            }

            document.getElementById('modalParticipantId').value = currentParticipantId;
            document.getElementById('modalStatus').value = currentStatus;
            document.getElementById('participantName').value = participantName;
            document.getElementById('notesText').value = '';

            // Verificar se Bootstrap está disponível
            if (typeof bootstrap !== 'undefined') {
                new bootstrap.Modal(document.getElementById('notesModal')).show();
            } else {
                // Fallback se Bootstrap não estiver disponível
                document.getElementById('notesModal').style.display = 'block';
                document.getElementById('notesModal').classList.add('show');
            }
        });
    });

    // Salvar status
    document.getElementById('saveStatus').addEventListener('click', function() {
        const participantId = document.getElementById('modalParticipantId').value;
        const status = document.getElementById('modalStatus').value;
        const notes = document.getElementById('notesText').value;

        fetch(`/deliveries/${deliveryId}/participants/${participantId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: status,
                notes: notes
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Atualizar a linha da tabela
                updateTableRow(participantId, status, notes);

                // Atualizar estatísticas
                updateStatistics();

                // Fechar modal
                if (typeof bootstrap !== 'undefined') {
                    bootstrap.Modal.getInstance(document.getElementById('notesModal')).hide();
                } else {
                    // Fallback se Bootstrap não estiver disponível
                    document.getElementById('notesModal').style.display = 'none';
                    document.getElementById('notesModal').classList.remove('show');
                }

                // Mostrar mensagem de sucesso
                showAlert('success', data.message);
            } else {
                showAlert('danger', 'Erro ao atualizar status do participante.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Erro ao comunicar com o servidor.');
        });
    });

    function updateTableRow(participantId, status, notes) {
        const row = document.querySelector(`tr[data-participant-id="${participantId}"]`);
        const statusCell = row.querySelector('.status-badge');
        const timeCell = row.querySelector('.delivery-time');
        const notesCell = row.querySelector('.participant-notes');

        // Atualizar atributo de status da linha
        row.setAttribute('data-status', status);

        // Atualizar badge de status
        let badgeClass, icon, text;
        switch(status) {
            case 'present':
                badgeClass = 'bg-success';
                icon = 'fa-check';
                text = 'Presente';
                timeCell.textContent = new Date().toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
                break;
            case 'absent':
                badgeClass = 'bg-danger';
                icon = 'fa-times';
                text = 'Ausente';
                timeCell.textContent = '-';
                break;
            case 'excused':
                badgeClass = 'bg-warning';
                icon = 'fa-file-medical';
                text = 'Justificado';
                timeCell.textContent = '-';
                break;
        }

        statusCell.innerHTML = `<span class="badge ${badgeClass}"><i class="fas ${icon}"></i> ${text}</span>`;
        notesCell.textContent = notes || '-';
    }

    function updateStatistics() {
        // Recarregar a página para atualizar estatísticas
        // Em uma implementação mais avançada, você poderia atualizar via AJAX
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    }

    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        const container = document.querySelector('.container-fluid');
        const firstRow = container.querySelector('.row');

        if (container && firstRow) {
            container.insertBefore(alertDiv, firstRow);
        } else {
            // Fallback: adicionar no início do container
            if (container) {
                container.insertAdjacentElement('afterbegin', alertDiv);
            }
        }

        setTimeout(() => {
            if (alertDiv && alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
});
</script>
@endpush
