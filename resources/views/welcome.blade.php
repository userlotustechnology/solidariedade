<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Solidariedade') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        * {
            box-sizing: border-box;
        }

        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="30" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="30" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s ease-in-out infinite;
        }

        .welcome-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 4rem 3rem;
            text-align: center;
            max-width: 600px;
            width: 100%;
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
            margin: 0 auto;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(180deg); }
        }

        .logo {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .welcome-subtitle {
            font-size: 1.2rem;
            color: #718096;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        .features {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
        }

        .feature {
            text-align: center;
        }

        .feature-icon {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .feature-text {
            font-size: 0.9rem;
            color: #718096;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .welcome-container {
                padding: 2rem 1.5rem;
                max-width: 100%;
                margin: 0;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="logo">
            <i class="fas fa-heart"></i>
        </div>

        <h1 class="welcome-title">{{ config('app.name', 'Solidariedade') }}</h1>

        <p class="welcome-subtitle">
            Sistema de gestão para distribuição de cestas básicas e assistência social.
            Gerencie participantes, entregas e acompanhe o impacto das suas ações solidárias.
        </p>

        @auth
            <a href="{{ route('home') }}" class="btn btn-primary btn-login">
                <i class="fas fa-tachometer-alt me-2"></i>
                Acessar Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>
                Fazer Login
            </a>
        @endauth

        <div class="features">
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="feature-text">
                    Gestão de<br>Participantes
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="feature-text">
                    Controle de<br>Entregas
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="feature-text">
                    Relatórios e<br>Estatísticas
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="feature-text">
                    Agendamento<br>Inteligente
                </div>
            </div>
        </div>
    </div>
</body>
</html>
