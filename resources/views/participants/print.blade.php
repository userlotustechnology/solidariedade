<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha do Participante - {{ $participant->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 12mm;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            background: white;
        }

        @media print {
            body {
                font-size: 10px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print { display: none !important; }
        }

        .container {
            max-width: 100%;
            width: 100%;
            border: 2px solid #0066cc;
            padding: 15px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #0066cc;
            padding-bottom: 10px;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
            padding: 12px;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            font-size: 20px;
            color: #0066cc;
            font-weight: bold;
            margin-bottom: 4px;
            letter-spacing: 1px;
        }

        .header p {
            font-size: 10px;
            color: #666;
            font-style: italic;
        }

        .photo-section {
            float: right;
            width: 90px;
            margin-left: 15px;
            margin-bottom: 15px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .photo {
            width: 74px;
            height: 90px;
            border: 1px solid #ddd;
            object-fit: cover;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }

        .no-photo {
            width: 74px;
            height: 90px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 4px;
            font-size: 9px;
            color: #666;
            text-align: center;
            margin: 0 auto;
        }

        .section {
            margin-bottom: 15px;
            clear: both;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
        }

        .section-title {
            background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
            color: white;
            padding: 8px 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .section-content {
            padding: 10px 12px;
            background: #fdfdfd;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }

        .row:last-child {
            margin-bottom: 0;
        }

        .col-2 { width: 16.66%; }
        .col-3 { width: 25%; }
        .col-4 { width: 33.33%; }
        .col-6 { width: 50%; }
        .col-8 { width: 66.66%; }
        .col-12 { width: 100%; }

        .field {
            padding: 0 6px 0 0;
        }

        .label {
            font-weight: 600;
            font-size: 9px;
            color: #555;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .value {
            background: white;
            border: 1px solid #d0d0d0;
            padding: 6px 8px;
            font-size: 10px;
            border-radius: 3px;
            min-height: 24px;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda !important;
            color: #155724 !important;
            border-color: #c3e6cb !important;
            font-weight: bold;
        }

        .status-inactive {
            background: #f8d7da !important;
            color: #721c24 !important;
            border-color: #f5c6cb !important;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            border-top: 2px solid #0066cc;
            padding-top: 10px;
            text-align: center;
            font-size: 9px;
            color: #666;
            background: #f8f9ff;
            padding: 10px;
            border-radius: 0 0 6px 6px;
        }

        .observations {
            min-height: 40px;
            line-height: 1.4;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        /* Quebras de linha compactas */
        br { line-height: 0.8; }

        /* Ícones usando símbolos */
        .icon-user::before { content: "👤 "; }
        .icon-contact::before { content: "📞 "; }
        .icon-address::before { content: "📍 "; }
        .icon-money::before { content: "💰 "; }
        .icon-note::before { content: "📝 "; }
        .icon-admin::before { content: "⚙️ "; }
        .text-right { text-align: right; }

        /* Quebras de linha compactas */
        br { line-height: 0.5; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>FICHA DO PARTICIPANTE</h1>
            <p>Sistema de Solidariedade - Gerado em {{ now()->format('d/m/Y H:i') }}</p>
        </div>

        <!-- Foto -->
        <div class="photo-section">
            @if($participant->photo)
                <img src="{{ asset('storage/' . $participant->photo) }}"
                     alt="Foto" class="photo">
            @else
                <div class="no-photo">
                    SEM<br>FOTO
                </div>
            @endif
        </div>

        <!-- Informações Pessoais -->
        <div class="section">
            <div class="section-title icon-user">DADOS PESSOAIS</div>
            <div class="section-content">
                <div class="row">
                    <div class="col-6 field">
                        <div class="label">Nome Completo</div>
                        <div class="value">{{ $participant->name }}</div>
                    </div>
                    <div class="col-3 field">
                        <div class="label">Idade</div>
                        <div class="value">{{ $participant->age }} anos</div>
                    </div>
                    <div class="col-3 field">
                        <div class="label">Gênero</div>
                        <div class="value">
                            @if($participant->gender === 'M') Masculino
                            @elseif($participant->gender === 'F') Feminino
                            @elseif($participant->gender === 'Other') Outro
                            @else Não informado @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 field">
                        <div class="label">Data Nascimento</div>
                        <div class="value">{{ $participant->birth_date->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-3 field">
                        <div class="label">Estado Civil</div>
                        <div class="value">
                            @switch($participant->marital_status)
                                @case('solteiro') Solteiro(a) @break
                                @case('casado') Casado(a) @break
                                @case('divorciado') Divorciado(a) @break
                                @case('viuvo') Viúvo(a) @break
                                @case('uniao_estavel') União Estável @break
                                @default Não informado
                            @endswitch
                        </div>
                    </div>
                    <div class="col-3 field">
                        <div class="label">{{ $participant->document_type ?? 'Documento' }}</div>
                        <div class="value">{{ $participant->document_number }}</div>
                    </div>
                    <div class="col-3 field">
                        <div class="label">Status</div>
                        <div class="value {{ $participant->active ? 'status-active' : 'status-inactive' }}">
                            {{ $participant->active ? 'ATIVO' : 'INATIVO' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contato -->
        <div class="section">
            <div class="section-title icon-contact">CONTATO</div>
            <div class="section-content">
                <div class="row">
                    <div class="col-4 field">
                        <div class="label">Telefone</div>
                        <div class="value">{{ $participant->formatted_phone ?? 'Não informado' }}</div>
                    </div>
                    <div class="col-8 field">
                        <div class="label">E-mail</div>
                        <div class="value">{{ $participant->email ?? 'Não informado' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="section">
            <div class="section-title icon-address">ENDEREÇO</div>
            <div class="section-content">
                <div class="row">
                    <div class="col-6 field">
                        <div class="label">Logradouro</div>
                        <div class="value">{{ $participant->address ?? 'Não informado' }}</div>
                    </div>
                    <div class="col-2 field">
                        <div class="label">Número</div>
                        <div class="value">{{ $participant->address_number ?? 'S/N' }}</div>
                    </div>
                    <div class="col-4 field">
                        <div class="label">Complemento</div>
                        <div class="value">{{ $participant->address_complement ?? '-' }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4 field">
                        <div class="label">Bairro</div>
                        <div class="value">{{ $participant->neighborhood ?? 'Não informado' }}</div>
                    </div>
                    <div class="col-4 field">
                        <div class="label">Cidade</div>
                        <div class="value">{{ $participant->city ?? 'Não informado' }}</div>
                    </div>
                    <div class="col-2 field">
                        <div class="label">UF</div>
                        <div class="value">{{ $participant->state ?? 'Não informado' }}</div>
                    </div>
                    <div class="col-2 field">
                        <div class="label">CEP</div>
                        <div class="value">{{ $participant->zip_code ?? 'Não informado' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações Socioeconômicas -->
        <div class="section">
            <div class="section-title">
                <i class="icon-socio"></i>DADOS SOCIOECONÔMICOS
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-3 field">
                        <div class="label">Pessoas na Família</div>
                        <div class="value">{{ $participant->family_members ?? 'Não informado' }}</div>
                    </div>
                    <div class="col-3 field">
                        <div class="label">Renda Familiar</div>
                        <div class="value">
                            @if($participant->monthly_income)
                                R$ {{ number_format($participant->monthly_income, 2, ',', '.') }}
                            @else
                                Não informado
                            @endif
                        </div>
                    </div>
                <div class="col-3 field">
                    <div class="label">Recebe Benefício?</div>
                    <div class="value">
                        @if($participant->receives_government_benefit === 1) Sim
                        @elseif($participant->receives_government_benefit === 0) Não
                        @else Não informado @endif
                    </div>
                </div>
                <div class="col-3 field">
                    <div class="label">Tipo de Benefício</div>
                    <div class="value">{{ $participant->benefit_type ?? '-' }}</div>
                </div>
            </div>
            </div>
        </div>

        <!-- Observações -->
        <div class="section">
            <div class="section-title">
                <i class="icon-note"></i>OBSERVAÇÕES
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-12 field">
                        <div class="value observations">{{ $participant->observations ?? 'Nenhuma observação registrada.' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações de Cadastro -->
        <div class="section">
            <div class="section-title">
                <i class="icon-register"></i>DADOS DO CADASTRO
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-4 field">
                        <div class="label">Cadastrado por</div>
                        <div class="value">{{ $participant->registeredBy->name ?? 'Sistema' }}</div>
                    </div>
                    <div class="col-4 field">
                        <div class="label">Data do Cadastro</div>
                        <div class="value">{{ $participant->registered_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="col-4 field">
                        <div class="label">Última Atualização</div>
                        <div class="value">{{ $participant->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodapé -->
        <div class="footer">
            ID do Participante: {{ $participant->id }} |
            Ficha gerada automaticamente pelo Sistema de Solidariedade
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
