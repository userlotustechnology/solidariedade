<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta        /* Header do cartão */
        .card-header {
            background: var(--primary-gradient);
            padding: 30px 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartão do Participante - {{ $participant->name }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            --shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .card-container {
            width: 750px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
            transform: scale(1);
            transition: transform 0.3s ease;
        }

        /* Header do cartão */
        .card-header {
            background: var(--primary-gradient);
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: translateX(0) translateY(0) rotate(0deg); }
            100% { transform: translateX(-20px) translateY(-20px) rotate(360deg); }
        }

        .header-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .participant-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .participant-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .participant-avatar .initials {
            font-size: 2.2rem;
            font-weight: 900;
            color: white;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .participant-main-info h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 8px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .participant-id {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 14px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 12px;
            backdrop-filter: blur(10px);
        }

        .quick-stats {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 16px;
            border-radius: 50px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-item i {
            font-size: 1.1rem;
        }

        /* Status Badge */
        .status-badge {
            position: absolute;
            top: 25px;
            right: 25px;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            z-index: 3;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.9);
            color: white;
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.9);
            color: white;
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
        }

        /* Body do cartão */
        .card-body {
            padding: 30px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
        }

        .section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .section-title i {
            font-size: 0.9rem;
            color: #667eea;
        }

        .section-value {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.3;
        }

        /* Seção especial para observações */
        .observations-section {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
        }

        /* Seção de endereço - ocupar toda a largura */
        .address-section {
            grid-column: 1 / -1;
        }

        .observations-section::before {
            display: none;
        }

        .observations-section .section-title {
            color: rgba(255, 255, 255, 0.9);
        }

        .observations-section .section-value {
            color: white;
            font-style: italic;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Footer */
        .card-footer {
            background: var(--dark-gradient);
            color: white;
            padding: 25px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'JetBrains Mono', monospace;
        }

        .footer-brand {
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        /* Responsive adjustments */
        @media (max-width: 900px) {
            .card-container {
                width: 100%;
                max-width: 800px;
            }

            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
        }

        /* Print styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .card-container {
                box-shadow: none;
                width: 100%;
            }

            .info-section:hover {
                transform: none;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            }
        }
    </style>
</head>
<body>
    <div class="card-container">
        <!-- Header -->
        <div class="card-header">
            <!-- Status Badge -->
            @if($participant->active)
                <div class="status-badge status-active">
                    <i class="fas fa-check-circle"></i> ATIVO
                </div>
            @else
                <div class="status-badge status-inactive">
                    <i class="fas fa-times-circle"></i> INATIVO
                </div>
            @endif
            <div class="header-content">
                <div class="participant-avatar">
                    @if($participant->photo && file_exists(public_path('storage/' . $participant->photo)))
                        <img src="{{ asset('storage/' . $participant->photo) }}" alt="{{ $participant->name }}">
                    @else
                        <div class="initials">
                            {{ strtoupper(substr($participant->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $participant->name)[1] ?? '', 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="participant-main-info">
                    <div class="participant-id">ID: {{ $participant->id }}</div>
                    <h1>{{ $participant->name }}</h1>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="info-grid">
                <!-- Informações Pessoais -->
                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-id-card"></i>
                        Documento
                    </div>
                    <div class="section-value">
                        {{ $participant->document_type ?? 'N/I' }}<br>
                        <small style="opacity: 0.7;">{{ $participant->document_number ?? 'Não informado' }}</small>
                    </div>
                </div>

                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-birthday-cake"></i>
                        Nascimento
                    </div>
                    <div class="section-value">
                        {{ $participant->birth_date->format('d/m/Y') }} <br>
                        <small style="opacity: 0.7;">{{ $participant->gender == "M" ? 'Masculino' : ($participant->gender == "F" ? 'Feminino' : 'Não informado') }}</small> |
                        <small style="opacity: 0.7;">{{ $participant->age ? $participant->age . ' anos' : 'Não informado' }}</small>
                    </div>
                </div>

                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-mobile-alt"></i>
                        Celular / E-mail
                    </div>
                    <div class="section-value">
                        {{ $participant->phone ?? 'Não informado' }} <br>
                        <small style="opacity: 0.7;">{{ $participant->email ?? 'Não informado e-mail' }}</small>
                    </div>
                </div>

                <!-- Dados Socioeconômicos -->
                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-users"></i>
                        Família
                    </div>
                    <div class="section-value">
                        {{ $participant->family_members ?? 'N/I' }} pessoas <br>
                        <small style="opacity: 0.7;">{{ $participant->marital_status ? strtoupper($participant->marital_status) :  'Não informado' }}</small>
                    </div>
                </div>

                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-dollar-sign"></i>
                        Renda Mensal
                    </div>
                    <div class="section-value">
                        @if($participant->monthly_income)
                            R$ {{ number_format($participant->monthly_income, 2, ',', '.') }}
                        @else
                            Não informado
                        @endif
                    </div>
                </div>

                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-hand-holding-heart"></i>
                        Benefício Gov.
                    </div>
                    <div class="section-value">
                        @if($participant->receives_government_benefit === 1)
                            <span style="color: #059669;">✓ {{ $participant->government_benefit_type ?? 'Sim' }}</span>
                        @elseif($participant->receives_government_benefit === 0)
                            <span style="color: #dc2626;">✗ Não</span>
                        @else
                            Não informado
                        @endif
                    </div>
                </div>

                <!-- Endereço -->
                <div class="info-section address-section">
                    <div class="section-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Endereço
                    </div>
                    <div class="section-value">
                        {{ $participant->address ?? 'Não informado' }}@if($participant->address_complement), {{ $participant->address_complement }}@endif @if($participant->neighborhood), {{ $participant->neighborhood }}@endif @if($participant->city), {{ $participant->city }}@endif @if($participant->state) - {{ $participant->state }}@endif @if($participant->zip_code), CEP: {{ $participant->zip_code }}@endif
                    </div>
                </div>

                <!-- Observações (se existirem) -->
                @if($participant->observations)
                <div class="info-section observations-section">
                    <div class="section-title">
                        <i class="fas fa-sticky-note"></i>
                        Observações Especiais
                    </div>
                    <div class="section-value">
                        "{{ $participant->observations }}"
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="card-footer">
            <div class="footer-brand">
                <i class="fas fa-heart"></i>
                Sistema de Solidariedade
            </div>
            <div class="footer-meta">
                <span>Cadastrado: {{ $participant->registered_at->format('d/m/Y') }}</span>
                <span>•</span>
                <span>Por: {{ $participant->registeredBy->name ?? 'Sistema' }}</span>
                <span>•</span>
                <span>{{ now()->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>

    <script>
        // Auto-imprimir se solicitado
        if (window.location.search.includes('auto-print=true')) {
            window.onload = function() {
                setTimeout(() => window.print(), 1000);
            };
        }
    </script>
</body>
</html>
