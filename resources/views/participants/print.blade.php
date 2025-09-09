<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha do Participante - {{ $participant->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @media print {
            body { font-size: 12px; }
            .page-break { page-break-before: always; }
            .no-print { display: none; }
            .card { border: 1px solid #ddd !important; }
        }
        body {
            font-family: Arial, sans-serif;
            background: white;
        }
        .header-logo {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 15px;
        }
        .participant-photo {
            max-width: 120px;
            max-height: 150px;
            object-fit: cover;
            border: 2px solid #ddd;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .info-value {
            background-color: #f8f9fa;
            padding: 8px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .section-title {
            background-color: #0066cc;
            color: white;
            padding: 8px 15px;
            margin: 20px 0 15px 0;
            border-radius: 4px;
            font-weight: bold;
        }
        .badge-print {
            background-color: #6c757d;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 0.8em;
        }
        .badge-success-print { background-color: #198754; }
        .badge-warning-print { background-color: #ffc107; color: #000; }
        .badge-danger-print { background-color: #dc3545; }
        .badge-info-print { background-color: #0dcaf0; color: #000; }
        .delivery-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .delivery-table th,
        .delivery-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .delivery-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Botão de Impressão -->
        <div class="no-print mb-3">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Imprimir Ficha
            </button>
            <a href="{{ route('participants.show', $participant) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <!-- Cabeçalho -->
        <div class="header-logo">
            <h2>FICHA DO PARTICIPANTE</h2>
            <h4>Sistema de Solidariedade</h4>
        </div>

        <div class="row">
            <!-- Informações Pessoais -->
            <div class="col-md-8">
                <div class="section-title">
                    <i class="fas fa-user"></i> INFORMAÇÕES PESSOAIS
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-label">Nome Completo</div>
                        <div class="info-value">{{ $participant->name }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-label">Idade</div>
                        <div class="info-value">{{ $participant->age }} anos</div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-label">Gênero</div>
                        <div class="info-value">
                            @if($participant->gender === 'M')
                                Masculino
                            @elseif($participant->gender === 'F')
                                Feminino
                            @elseif($participant->gender === 'Other')
                                Outro
                            @else
                                Não informado
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="info-label">Estado Civil</div>
                        <div class="info-value">
                            @switch($participant->marital_status)
                                @case('solteiro')
                                    Solteiro(a)
                                    @break
                                @case('casado')
                                    Casado(a)
                                    @break
                                @case('divorciado')
                                    Divorciado(a)
                                    @break
                                @case('viuvo')
                                    Viúvo(a)
                                    @break
                                @case('uniao_estavel')
                                    União Estável
                                    @break
                                @default
                                    Não informado
                            @endswitch
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-label">Tipo de Documento</div>
                        <div class="info-value">{{ $participant->document_type }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-label">Número do Documento</div>
                        <div class="info-value">{{ $participant->formatted_document }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="info-label">Data de Nascimento</div>
                        <div class="info-value">{{ $participant->birth_date->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-label">Telefone</div>
                        <div class="info-value">{{ $participant->formatted_phone ?: 'Não informado' }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-label">E-mail</div>
                        <div class="info-value">{{ $participant->email ?: 'Não informado' }}</div>
                    </div>
                </div>
            </div>

            <!-- Foto -->
            <div class="col-md-4">
                <div class="section-title">
                    <i class="fas fa-camera"></i> FOTO
                </div>
                <div class="text-center">
                    @if($participant->photo)
                        <img src="{{ asset('storage/' . $participant->photo) }}"
                             alt="Foto de {{ $participant->name }}"
                             class="participant-photo img-fluid rounded">
                    @else
                        <div class="border rounded d-flex align-items-center justify-content-center bg-light participant-photo" style="height: 150px; width: 120px; margin: 0 auto;">
                            <div class="text-center text-muted">
                                <i class="fas fa-user fa-2x mb-2"></i>
                                <p class="mb-0 small">Sem foto</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="section-title">
            <i class="fas fa-map-marker-alt"></i> ENDEREÇO
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="info-label">Endereço</div>
                <div class="info-value">{{ $participant->address }}</div>
            </div>
            <div class="col-md-3">
                <div class="info-label">Complemento</div>
                <div class="info-value">{{ $participant->address_complement ?: 'Não informado' }}</div>
            </div>
            <div class="col-md-3">
                <div class="info-label">Bairro</div>
                <div class="info-value">{{ $participant->neighborhood }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="info-label">Cidade</div>
                <div class="info-value">{{ $participant->city }}</div>
            </div>
            <div class="col-md-2">
                <div class="info-label">Estado</div>
                <div class="info-value">{{ $participant->state }}</div>
            </div>
            <div class="col-md-3">
                <div class="info-label">CEP</div>
                <div class="info-value">{{ $participant->zip_code }}</div>
            </div>
        </div>

        <!-- Informações Familiares -->
        <div class="section-title">
            <i class="fas fa-users"></i> INFORMAÇÕES FAMILIARES
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="info-label">Pessoas na Família</div>
                <div class="info-value">
                    {{ $participant->family_members }}
                    {{ $participant->family_members === 1 ? 'pessoa' : 'pessoas' }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-label">Renda Mensal Familiar</div>
                <div class="info-value">
                    @if($participant->monthly_income)
                        R$ {{ number_format($participant->monthly_income, 2, ',', '.') }}
                    @else
                        Não informado
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-label">Renda per capita</div>
                <div class="info-value">
                    @if($participant->monthly_income)
                        R$ {{ number_format($participant->monthly_income / $participant->family_members, 2, ',', '.') }}
                    @else
                        Não calculado
                    @endif
                </div>
            </div>
        </div>

        <!-- Benefícios e Documentação -->
        <div class="section-title">
            <i class="fas fa-file-alt"></i> BENEFÍCIOS E DOCUMENTAÇÃO
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="info-label">Recebe Benefício do Governo</div>
                <div class="info-value">
                    @if($participant->receives_government_benefit)
                        <span class="badge-print badge-success-print">Sim</span>
                    @else
                        <span class="badge-print">Não</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-label">Tipo de Benefício</div>
                <div class="info-value">{{ $participant->government_benefit_type ?: 'Não informado' }}</div>
            </div>
            <div class="col-md-4">
                <div class="info-label">Possui Documentos Básicos</div>
                <div class="info-value">
                    @if($participant->has_documents)
                        <span class="badge-print badge-success-print">Sim</span>
                    @else
                        <span class="badge-print badge-warning-print">Não</span>
                    @endif
                    <br><small>RG, CPF, Comprovante de residência</small>
                </div>
            </div>
        </div>

        <!-- Situação Trabalhista -->
        <div class="section-title">
            <i class="fas fa-briefcase"></i> SITUAÇÃO TRABALHISTA
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="info-label">Situação de Trabalho</div>
                <div class="info-value">
                    @switch($participant->employment_status)
                        @case('empregado')
                            <span class="badge-print badge-success-print">Empregado</span>
                            @break
                        @case('desempregado')
                            <span class="badge-print badge-danger-print">Desempregado</span>
                            @break
                        @case('aposentado')
                            <span class="badge-print badge-info-print">Aposentado</span>
                            @break
                        @case('pensionista')
                            <span class="badge-print badge-info-print">Pensionista</span>
                            @break
                        @case('autonomo')
                            <span class="badge-print badge-warning-print">Autônomo</span>
                            @break
                        @default
                            Não informado
                    @endswitch
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-label">Local de Trabalho</div>
                <div class="info-value">{{ $participant->workplace ?: 'Não informado' }}</div>
            </div>
        </div>

        @if($participant->observations)
            <div class="section-title">
                <i class="fas fa-sticky-note"></i> OBSERVAÇÕES
            </div>
            <div class="info-value">{{ $participant->observations }}</div>
        @endif

        <!-- Histórico de Entregas -->
        <div class="section-title">
            <i class="fas fa-history"></i> HISTÓRICO DE ENTREGAS
        </div>

        @if($participant->deliveryRecords->count() > 0)
            <table class="delivery-table">
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
                    @foreach($participant->deliveryRecords->sortByDesc('delivery.delivery_date') as $record)
                        <tr>
                            <td>{{ $record->delivery->delivery_date->format('d/m/Y') }}</td>
                            <td>{{ $record->delivery->title }}</td>
                            <td>
                                @if($record->delivered_at)
                                    {{ $record->delivered_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($record->deliveredBy)
                                    {{ $record->deliveredBy->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($record->delivered_at)
                                    <span class="badge-print badge-success-print">Recebido</span>
                                @else
                                    <span class="badge-print badge-warning-print">Pendente</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Estatísticas -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="info-label">Cestas Recebidas</div>
                    <div class="info-value text-center">
                        <strong>{{ $participant->deliveryRecords->whereNotNull('delivered_at')->count() }}</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-label">Cestas Pendentes</div>
                    <div class="info-value text-center">
                        <strong>{{ $participant->deliveryRecords->whereNull('delivered_at')->count() }}</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-label">Total de Entregas</div>
                    <div class="info-value text-center">
                        <strong>{{ $participant->deliveryRecords->count() }}</strong>
                    </div>
                </div>
            </div>
        @else
            <div class="info-value text-center">
                <i class="fas fa-info-circle"></i>
                Este participante ainda não possui histórico de entregas.
            </div>
        @endif

        <!-- Informações de Cadastro -->
        <div class="section-title">
            <i class="fas fa-info-circle"></i> INFORMAÇÕES DE CADASTRO
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="info-label">Cadastrado por</div>
                <div class="info-value">{{ $participant->registeredBy->name }}</div>
            </div>
            <div class="col-md-4">
                <div class="info-label">Data do Cadastro</div>
                <div class="info-value">{{ $participant->registered_at->format('d/m/Y H:i') }}</div>
            </div>
            <div class="col-md-4">
                <div class="info-label">Última Atualização</div>
                <div class="info-value">{{ $participant->updated_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>

        <!-- Status -->
        <div class="row mt-3">
            <div class="col-12 text-center">
                <div class="info-label">Status do Participante</div>
                <div class="info-value">
                    @if($participant->active)
                        <span class="badge-print badge-success-print">PARTICIPANTE ATIVO</span>
                    @else
                        <span class="badge-print badge-warning-print">PARTICIPANTE INATIVO</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Rodapé -->
        <div class="mt-4 text-center" style="border-top: 1px solid #ddd; padding-top: 15px;">
            <small class="text-muted">
                Ficha gerada em {{ now()->format('d/m/Y H:i') }} - Sistema de Solidariedade
            </small>
        </div>
    </div>

    <script>
        // Auto-imprimir se solicitado via parâmetro na URL
        if (window.location.search.includes('auto-print=true')) {
            window.onload = function() {
                window.print();
            };
        }
    </script>
</body>
</html>
