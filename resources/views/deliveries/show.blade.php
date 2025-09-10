@extends('layouts.app')

@section('title', 'Gerenciar Participantes da Entrega')

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
                                <i class="ti-truck me-3"></i>{{ $delivery->title }}
                            </h1>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <span class="fs-5 opacity-75">
                                    <i class="ti-calendar me-2"></i>
                                    {{ $delivery->delivery_date->format('d/m/Y') }}
                                </span>
                                @switch($delivery->status)
                                    @case('scheduled')
                                        <span class="badge bg-warning bg-opacity-75 text-dark fs-6 px-3 py-2">
                                            <i class="ti-clock me-1"></i>Agendada
                                        </span>
                                        @break
                                    @case('in_progress')
                                        <span class="badge bg-info bg-opacity-75 text-dark fs-6 px-3 py-2">
                                            <i class="ti-reload me-1"></i>Em Andamento
                                        </span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-success bg-opacity-75 text-dark fs-6 px-3 py-2">
                                            <i class="ti-check me-1"></i>Concluída
                                        </span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger bg-opacity-75 text-white fs-6 px-3 py-2">
                                            <i class="ti-close me-1"></i>Cancelada
                                        </span>
                                        @break
                                @endswitch
                            </div>
                            @if($delivery->description)
                                <p class="fs-6 mb-0 opacity-75">{{ $delivery->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Estatísticas da Entrega -->
    @php
        $totalParticipants = count($participantStatuses);
        $presentCount = collect($participantStatuses)->where('status', 'present')->count();
        $absentCount = collect($participantStatuses)->where('status', 'absent')->count();
        $excusedCount = collect($participantStatuses)->where('status', 'excused')->count();
        $pendingCount = collect($participantStatuses)->where('status', 'pending')->count();
        $progressPercentage = $totalParticipants > 0 ? (($presentCount + $absentCount + $excusedCount) / $totalParticipants) * 100 : 0;
    @endphp

    <div class="row mb-4">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="text-center">
                        <div class="text-white-50 fw-semibold mb-1">TOTAL DE PARTICIPANTES</div>
                        <h2 class="fw-bold mb-0">{{ $totalParticipants }}</h2>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="ti-users me-1"></i>Pessoas na entrega
                            </small>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 end-0 pe-3 pb-2">
                        <i class="ti-users opacity-10" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #11998e 0%, #38ef7d 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="text-center">
                        <div class="text-white-50 fw-semibold mb-1">PRESENTES</div>
                        <h2 class="fw-bold mb-0">{{ $presentCount }}</h2>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="ti-check me-1"></i>Confirmaram presença
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #ff416c 0%, #ff4b2b 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="text-center">
                        <div class="text-white-50 fw-semibold mb-1">AUSENTES</div>
                        <h2 class="fw-bold mb-0">{{ $absentCount }}</h2>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="ti-close me-1"></i>Não compareceram
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="text-center">
                        <div class="text-white-50 fw-semibold mb-1">JUSTIFICADOS</div>
                        <h2 class="fw-bold mb-0">{{ $excusedCount }}</h2>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="ti-info me-1"></i>Com justificativa
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body text-white position-relative overflow-hidden">
                    <div class="text-center">
                        <div class="text-white-50 fw-semibold mb-1">PENDENTES</div>
                        <h2 class="fw-bold mb-0">{{ $pendingCount }}</h2>
                        <div class="mt-2">
                            <small class="text-white-50">
                                <i class="ti-clock me-1"></i>Aguardando resposta
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #a8edea 0%, #fed6e3 100%);">
                <div class="card-body position-relative overflow-hidden">
                    <div class="text-center">
                        <div class="text-muted fw-semibold mb-1">PROGRESSO</div>
                        <h2 class="fw-bold mb-0 text-primary">{{ number_format($progressPercentage, 1) }}%</h2>
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="ti-bar-chart me-1"></i>Entrega processada
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Participantes -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-users me-2"></i>Participantes da Entrega
                            <span class="badge bg-primary ms-2">{{ $totalParticipants }}</span>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="searchParticipant" class="form-label fw-semibold">Pesquisar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ti-search text-muted"></i>
                                </span>
                                <input type="text" id="searchParticipant" class="form-control border-start-0"
                                       placeholder="Nome do participante">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="filterStatus" class="form-label fw-semibold">Status</label>
                            <select id="filterStatus" class="form-select">
                                <option value="">Todos os status</option>
                                <option value="pending">Pendentes</option>
                                <option value="present">Presentes</option>
                                <option value="absent">Ausentes</option>
                                <option value="excused">Justificados</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div style="margin-top: 32px;">
                                <button class="btn btn-outline-secondary" id="clearFilters">
                                    <i class="ti-refresh me-1"></i>Limpar Filtros
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="participantsTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 py-3 ps-4">
                                        <div class="fw-semibold text-dark">Participante</div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="fw-semibold text-dark">Documento</div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="fw-semibold text-dark">Contato</div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="fw-semibold text-dark">Família</div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="fw-semibold text-dark">Status</div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="fw-semibold text-dark">Horário</div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="fw-semibold text-dark">Observações</div>
                                    </th>
                                    <th class="border-0 py-3 text-center pe-4">
                                        <div class="fw-semibold text-dark">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participantStatuses as $participantId => $data)
                                    @php
                                        $participant = $data['participant'];
                                        $record = $data['record'];
                                        $status = $data['status'];
                                    @endphp
                                    <tr data-participant-id="{{ $participantId }}" data-status="{{ $status }}" class="align-middle">
                                        <td class="py-3 ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <i class="ti-user text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 fw-bold">{{ $participant->name }}</h6>
                                                    <small class="text-muted">ID: {{ $participant->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div>
                                                <span class="badge bg-light text-dark border">
                                                    {{ $participant->document_type }}
                                                </span>
                                                <div class="mt-1">
                                                    <small class="text-muted">{{ $participant->document_number }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div>
                                                @if($participant->phone)
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="ti-phone text-muted me-1"></i>
                                                        <small>{{ $participant->phone }}</small>
                                                    </div>
                                                @endif
                                                @if($participant->email)
                                                    <div class="d-flex align-items-center">
                                                        <i class="ti-mail text-muted me-1"></i>
                                                        <small>{{ Str::limit($participant->email, 20) }}</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div>
                                                <span class="badge bg-info bg-opacity-10 text-info border border-info">
                                                    <i class="ti-users me-1"></i>
                                                    {{ $participant->family_members }}
                                                    {{ $participant->family_members === 1 ? 'pessoa' : 'pessoas' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <span class="status-badge status-{{ $status }}">
                                                @switch($status)
                                                    @case('present')
                                                        <span class="badge bg-success bg-opacity-10 text-success border border-success">
                                                            <i class="ti-check me-1"></i>Presente
                                                        </span>
                                                        @break
                                                    @case('absent')
                                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">
                                                            <i class="ti-close me-1"></i>Ausente
                                                        </span>
                                                        @break
                                                    @case('excused')
                                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">
                                                            <i class="ti-info me-1"></i>Justificado
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary">
                                                            <i class="ti-clock me-1"></i>Pendente
                                                        </span>
                                                @endswitch
                                            </span>
                                        </td>
                                        <td class="py-3 delivery-time">
                                            @if($record && $record->delivered_at)
                                                <div class="text-success">
                                                    <i class="ti-clock me-1"></i>
                                                    {{ $record->delivered_at->format('H:i') }}
                                                </div>
                                                <small class="text-muted">{{ $record->delivered_at->format('d/m/Y') }}</small>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="py-3 participant-notes">
                                            @if($record && $record->notes)
                                                <div class="text-truncate" style="max-width: 150px;" title="{{ $record->notes }}">
                                                    {{ $record->notes }}
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center py-3 pe-4">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-success btn-sm mark-present"
                                                        data-participant-id="{{ $participantId }}"
                                                        title="Marcar como Presente">
                                                    <i class="ti-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-sm mark-absent"
                                                        data-participant-id="{{ $participantId }}"
                                                        title="Marcar como Ausente">
                                                    <i class="ti-close"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-warning btn-sm mark-excused"
                                                        data-participant-id="{{ $participantId }}"
                                                        title="Marcar como Justificado">
                                                    <i class="ti-info"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#notesModal"
                                                        data-participant-id="{{ $participantId }}"
                                                        data-participant-name="{{ $participant->name }}"
                                                        title="Adicionar Observação">
                                                    <i class="ti-pencil"></i>
                                                </button>
                                                <a href="{{ route('participants.show', $participant->id) }}"
                                                   class="btn btn-outline-info btn-sm"
                                                   title="Ver Detalhes">
                                                    <i class="ti-eye"></i>
                                                </a>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="notesModalLabel">
                    <i class="ti-comment me-2"></i>Adicionar Observação
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" id="modalParticipantId">
                <input type="hidden" id="modalStatus">

                <div class="mb-3">
                    <label for="participantName" class="form-label fw-bold text-muted">Participante</label>
                    <input type="text" class="form-control bg-light" id="participantName" readonly>
                </div>

                <div class="mb-3">
                    <label for="statusText" class="form-label fw-bold text-muted">Status</label>
                    <input type="text" class="form-control bg-light" id="statusText" readonly>
                </div>

                <div class="mb-3">
                    <label for="notesText" class="form-label fw-bold text-muted">Observações</label>
                    <textarea class="form-control" id="notesText" rows="4"
                              placeholder="Digite observações sobre esta marcação..."></textarea>
                    <small class="form-text text-muted">
                        <i class="ti-info-alt me-1"></i>
                        Adicione informações relevantes sobre a presença/ausência do participante.
                    </small>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti-close me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="saveStatus">
                    <i class="ti-check me-1"></i>Confirmar
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .table tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    .status-badge {
        min-width: 100px;
        display: inline-block;
    }

    .btn-group .btn {
        margin: 0 1px;
        transition: all 0.2s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .border-bottom {
        border-bottom: 1px solid #dee2e6 !important;
    }

    .bg-gradient {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .modal-content {
        border-radius: 0.75rem;
    }

    .modal-header {
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .modal-footer {
        border-radius: 0 0 0.75rem 0.75rem;
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
            const firstCell = row.querySelector('td:first-child');
            const name = firstCell ? firstCell.textContent.toLowerCase() : '';
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

            // Verificação segura para obter o nome do participante
            let participantName = '';
            if (row) {
                const firstCell = row.querySelector('td:first-child');
                if (firstCell) {
                    const h6Element = firstCell.querySelector('h6');
                    participantName = h6Element ? h6Element.textContent.trim() : firstCell.textContent.trim();
                }
            }

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
        if (!row) {
            console.error('Linha do participante não encontrada:', participantId);
            return;
        }

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
                if (timeCell) {
                    timeCell.textContent = new Date().toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
                }
                break;
            case 'absent':
                badgeClass = 'bg-danger';
                icon = 'fa-times';
                text = 'Ausente';
                if (timeCell) {
                    timeCell.textContent = '-';
                }
                break;
            case 'excused':
                badgeClass = 'bg-warning';
                icon = 'fa-file-medical';
                text = 'Justificado';
                if (timeCell) {
                    timeCell.textContent = '-';
                }
                break;
        }

        if (statusCell) {
            statusCell.innerHTML = `<span class="badge ${badgeClass}"><i class="fas ${icon}"></i> ${text}</span>`;
        }
        if (notesCell) {
            notesCell.textContent = notes || '-';
        }
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
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = `
            top: 80px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        `;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Inserir diretamente no body para posição fixa
        document.body.appendChild(alertDiv);

        // Auto-remover após 5 segundos
        setTimeout(() => {
            if (alertDiv && alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
});
</script>
@endpush
