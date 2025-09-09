<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Solidariedade') }}</title>

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

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem 2.5rem;
            text-align: center;
            max-width: 450px;
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

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 1rem;
            color: #718096;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
            text-align: left;
            display: block;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.875rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            width: 100%;
            color: white;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            color: white;
        }

        .btn-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-link:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-check-label {
            color: #4a5568;
            font-weight: 500;
        }

        .invalid-feedback {
            color: #e53e3e;
            font-weight: 500;
        }

        .is-invalid {
            border-color: #e53e3e;
        }

        .back-to-home {
            position: absolute;
            top: 20px;
            left: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .back-to-home:hover {
            color: rgba(255, 255, 255, 1);
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .login-container {
                padding: 2rem 1.5rem;
                max-width: 100%;
                margin: 0;
            }

            .login-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="back-to-home">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="login-container">
        <div class="logo">
            <i class="fas fa-heart"></i>
        </div>

        <h1 class="login-title">Bem-vindo de volta!</h1>

        <p class="login-subtitle">
            Acesse sua conta para continuar gerenciando as ações de solidariedade.
        </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-2"></i>Email
                </label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       autofocus
                       placeholder="seu@email.com">

                @error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="fas fa-lock me-2"></i>Senha
                </label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="••••••••">

                @error('password')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check text-start">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Lembrar de mim
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Entrar
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="btn-link" href="{{ route('password.request') }}">
                        <i class="fas fa-question-circle me-1"></i>
                        Esqueceu sua senha?
                    </a>
                </div>
            @endif
        </form>

        <div class="mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
            <small class="text-muted">
                <i class="fas fa-shield-alt me-1"></i>
                Acesso seguro ao sistema {{ config('app.name') }}
            </small>
        </div>
    </div>
</body>
</html>
