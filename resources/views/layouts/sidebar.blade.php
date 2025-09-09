<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema de Solidariedade') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar superior */
        .navbar-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }

        .navbar-brand h4 {
            margin: 0;
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #4B49AC 0%, #6C5CE7 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }

        .sidebar-header .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-header .logo-icon {
            width: 32px;
            height: 32px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: color 0.3s ease;
        }

        .sidebar-toggle:hover {
            color: white;
        }

        /* Menu */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 20px 0 0 0;
        }

        .nav-item {
            margin: 2px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            border-radius: 0;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            text-decoration: none;
        }

        .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.15);
            border-right: 3px solid #FFD700;
        }

        .nav-link .menu-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            text-align: center;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-link .menu-title {
            font-weight: 500;
            font-size: 0.9rem;
            flex: 1;
        }

        .nav-link .menu-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 12px;
        }

        .nav-link .badge-count {
            background: rgba(255,255,255,0.25);
            color: white;
            border-radius: 12px;
            padding: 2px 8px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .nav-link .badge-count.warning {
            background: #FFD700;
            color: #2c3e50;
        }

        .nav-link .badge-count.success {
            background: #27AE60;
            color: white;
        }

        .nav-link .badge-count.danger {
            background: #E74C3C;
            color: white;
        }

        /* Submenu */
        .submenu {
            background: rgba(0,0,0,0.1);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .submenu.show {
            max-height: 400px;
        }

        .submenu .nav-link {
            padding: 10px 20px 10px 52px;
            font-size: 0.85rem;
            border-right: none;
        }

        .submenu .nav-link.active {
            border-right: 3px solid #FFD700;
        }

        .nav-item.open .menu-arrow {
            transform: rotate(90deg);
        }

        /* Collapsed state */
        .sidebar.collapsed .menu-title,
        .sidebar.collapsed .menu-arrow,
        .sidebar.collapsed .sidebar-header h4,
        .sidebar.collapsed .badge-count {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .sidebar.collapsed .menu-icon {
            margin-right: 0;
        }

        .sidebar.collapsed .submenu {
            display: none;
        }

        /* User info */
        .user-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.1);
        }

        .user-info .user-details {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-info .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .user-info .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }

        .user-info .user-role {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            margin: 0;
        }

        .user-info .logout-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.8);
            cursor: pointer;
            font-size: 16px;
            margin-left: auto;
            padding: 4px;
            border-radius: 4px;
            transition: color 0.3s ease;
        }

        .user-info .logout-btn:hover {
            color: white;
        }

        /* Main content */
        .main-content {
            margin-left: 280px;
            margin-top: 60px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 60px);
            padding: 20px;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .navbar-brand.expanded {
            margin-left: 70px;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .navbar-brand {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block !important;
            }
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #4B49AC;
            padding: 8px;
            border-radius: 4px;
        }

        /* Notifications */
        .notification-dropdown {
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #E74C3C;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Alerts */
        .alert {
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
        }

        .alert-success {
            background: #D5F4E6;
            color: #0F5132;
            border-left: 4px solid #27AE60;
        }

        .alert-danger {
            background: #F8D7DA;
            color: #721C24;
            border-left: 4px solid #E74C3C;
        }

        .alert-warning {
            background: #FFF3CD;
            color: #664D03;
            border-left: 4px solid #FFD700;
        }

        .alert-info {
            background: #D1ECF1;
            color: #055160;
            border-left: 4px solid #3498DB;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        @auth
        <!-- Navbar Superior -->
        <nav class="navbar-top" aria-label="Barra de navegação superior">
            <div class="navbar-brand" id="navbar-brand">
                <button class="mobile-toggle me-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h4>@yield('page-title', 'Dashboard')</h4>
            </div>

            <div class="navbar-actions">
                <!-- Notificações -->
                <div class="notification-dropdown">
                    <button class="btn btn-link text-muted" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Notificações</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-plus text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 small">Novo participante cadastrado</p>
                                    <small class="text-muted">2 min atrás</small>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-truck text-info"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 small">Entrega realizada</p>
                                    <small class="text-muted">1 hora atrás</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center" href="#">Ver todas</a>
                    </div>
                </div>

                <!-- Usuário -->
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configurações</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar" aria-label="Menu lateral">
            <!-- Header -->
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h4>{{ config('app.name', 'Solidariedade') }}</h4>
                </div>
                <button class="sidebar-toggle d-none d-md-block" onclick="toggleSidebar()">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <!-- Menu -->
            <ul class="sidebar-menu">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <div class="menu-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <!-- Participantes -->
                @if(auth()->user()->hasPermission('participants.view'))
                <li class="nav-item {{ request()->routeIs('participants.*') ? 'open' : '' }}">
                    <button type="button" class="nav-link" onclick="toggleSubmenu(this)">
                        <div class="menu-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="menu-title">Participantes</span>
                        @php
                            $totalParticipants = \App\Models\Participant::count();
                        @endphp
                        <span class="badge-count">{{ $totalParticipants }}</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </button>
                    <ul class="submenu {{ request()->routeIs('participants.*') ? 'show' : '' }}">
                        <li class="nav-item">
                            <a href="{{ route('participants.index') }}" class="nav-link {{ request()->routeIs('participants.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-list"></i>
                                </div>
                                <span class="menu-title">Listar Todos</span>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('participants.create'))
                        <li class="nav-item">
                            <a href="{{ route('participants.create') }}" class="nav-link {{ request()->routeIs('participants.create') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="menu-title">Novo Participante</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('participants.index', ['status' => 'active']) }}" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span class="menu-title">Ativos</span>
                                @php
                                    $activeParticipants = \App\Models\Participant::where('active', true)->count();
                                @endphp
                                <span class="badge-count success">{{ $activeParticipants }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('participants.index', ['status' => 'inactive']) }}" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <span class="menu-title">Inativos</span>
                                @php
                                    $inactiveParticipants = \App\Models\Participant::where('active', false)->count();
                                @endphp
                                @if($inactiveParticipants > 0)
                                <span class="badge-count danger">{{ $inactiveParticipants }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Entregas -->
                @if(auth()->user()->hasPermission('deliveries.view'))
                <li class="nav-item {{ request()->routeIs('deliveries.*') ? 'open' : '' }}">
                    <button type="button" class="nav-link" onclick="toggleSubmenu(this)">
                        <div class="menu-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <span class="menu-title">Entregas</span>
                        @php
                            $totalDeliveries = \App\Models\Delivery::count();
                        @endphp
                        <span class="badge-count">{{ $totalDeliveries }}</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </button>
                    <ul class="submenu {{ request()->routeIs('deliveries.*') ? 'show' : '' }}">
                        <li class="nav-item">
                            <a href="{{ route('deliveries.index') }}" class="nav-link {{ request()->routeIs('deliveries.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-list"></i>
                                </div>
                                <span class="menu-title">Todas as Entregas</span>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('deliveries.create'))
                        <li class="nav-item">
                            <a href="{{ route('deliveries.create') }}" class="nav-link {{ request()->routeIs('deliveries.create') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="menu-title">Nova Entrega</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('deliveries.index') }}?status=scheduled" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <span class="menu-title">Agendadas</span>
                                @php
                                    $scheduledDeliveries = \App\Models\Delivery::where('status', 'scheduled')->count();
                                @endphp
                                @if($scheduledDeliveries > 0)
                                <span class="badge-count warning">{{ $scheduledDeliveries }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('deliveries.index') }}?status=completed" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="menu-title">Concluídas</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Registros de Entrega -->
                @if(auth()->user()->hasPermission('delivery_records.view'))
                <li class="nav-item">
                    <button type="button" class="nav-link" onclick="toggleSubmenu(this)">
                        <div class="menu-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <span class="menu-title">Registros</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </button>
                    <ul class="submenu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <span class="menu-title">Histórico Completo</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <span class="menu-title">Entregas do Mês</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-user-clock"></i>
                                </div>
                                <span class="menu-title">Ausências</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Relatórios -->
                @if(auth()->user()->hasPermission('reports.view'))
                <li class="nav-item">
                    <button type="button" class="nav-link" onclick="toggleSubmenu(this)">
                        <div class="menu-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <span class="menu-title">Relatórios</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </button>
                    <ul class="submenu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <span class="menu-title">Estatísticas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <span class="menu-title">Relatório Mensal</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-file-excel"></i>
                                </div>
                                <span class="menu-title">Exportar Excel</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Administração -->
                @if(auth()->user()->hasPermission('users.view'))
                <li class="nav-item {{ request()->routeIs('users.*') ? 'open' : '' }}">
                    <button type="button" class="nav-link" onclick="toggleSubmenu(this)">
                        <div class="menu-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <span class="menu-title">Administração</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </button>
                    <ul class="submenu {{ request()->routeIs('users.*') ? 'show' : '' }}">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-user-cog"></i>
                                </div>
                                <span class="menu-title">Usuários</span>
                                @php
                                    $totalUsers = \App\Models\User::count();
                                @endphp
                                <span class="badge-count">{{ $totalUsers }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <span class="menu-title">Permissões</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <span class="menu-title">Backup</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="menu-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <span class="menu-title">Configurações</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>

            <!-- User Info -->
            <div class="user-info">
                <div class="user-details">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="user-name">{{ Auth::user()->name }}</p>
                        <p class="user-role">
                            @if(Auth::user()->hasRole('administrator'))
                                Administrador
                            @elseif(Auth::user()->hasRole('operator'))
                                Operador
                            @else
                                Usuário
                            @endif
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="logout-btn" title="Sair">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        @endauth

        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endauth
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const navbarBrand = document.getElementById('navbar-brand');

            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                navbarBrand.classList.toggle('expanded');
            }
        }

        function toggleSubmenu(element) {
            const submenu = element.nextElementSibling;
            const menuItem = element.parentElement;

            // Close other open submenus
            document.querySelectorAll('.submenu.show').forEach(sub => {
                if (sub !== submenu) {
                    sub.classList.remove('show');
                    sub.parentElement.classList.remove('open');
                }
            });

            // Toggle current submenu
            submenu.classList.toggle('show');
            menuItem.classList.toggle('open');
        }

        // Auto-open submenu if child is active
        document.addEventListener('DOMContentLoaded', function() {
            const activeLink = document.querySelector('.submenu .nav-link.active');
            if (activeLink) {
                const submenu = activeLink.closest('.submenu');
                const parentMenuItem = submenu.previousElementSibling.parentElement;

                submenu.classList.add('show');
                parentMenuItem.classList.add('open');
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const toggle = document.querySelector('.mobile-toggle');

                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .top-navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
            z-index: 999;
        }

        .content-area {
            padding: 2rem;
        }

        .sidebar.collapsed .menu-text,
        .sidebar.collapsed .menu-arrow,
        .sidebar.collapsed .sidebar-header h4 {
            display: none;
        }

        .sidebar.collapsed .menu-link {
            justify-content: center;
            padding: 1rem;
        }

        .sidebar.collapsed .menu-icon {
            margin-right: 0;
        }

        .user-info {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
            background: rgba(0,0,0,0.1);
        }

        .user-info .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .user-info .user-details {
            flex: 1;
        }

        .user-info .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }

        .user-info .user-role {
            font-size: 0.8rem;
            opacity: 0.7;
            margin: 0;
        }

        .badge-count {
            background: #ff4757;
            color: white;
            border-radius: 10px;
            padding: 2px 6px;
            font-size: 0.7rem;
            margin-left: auto;
            min-width: 18px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block !important;
            }
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #667eea;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        @auth
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4>{{ config('app.name', 'Sistema') }}</h4>
                <button class="toggle-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <ul class="sidebar-menu">
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ route('home') }}" class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt menu-icon"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Participantes -->
                @if(auth()->user()->hasPermission('participants.view'))
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="toggleSubmenu(this)">
                        <i class="fas fa-users menu-icon"></i>
                        <span class="menu-text">Participantes</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('participants.index') }}" class="menu-link {{ request()->routeIs('participants.index') ? 'active' : '' }}">
                                <i class="fas fa-list menu-icon"></i>
                                <span class="menu-text">Listar Todos</span>
                                @php
                                    $totalParticipants = \App\Models\Participant::count();
                                @endphp
                                <span class="badge-count">{{ $totalParticipants }}</span>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('participants.create'))
                        <li>
                            <a href="{{ route('participants.create') }}" class="menu-link {{ request()->routeIs('participants.create') ? 'active' : '' }}">
                                <i class="fas fa-plus menu-icon"></i>
                                <span class="menu-text">Novo Participante</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('participants.index', ['status' => 'active']) }}" class="menu-link">
                                <i class="fas fa-check-circle menu-icon"></i>
                                <span class="menu-text">Ativos</span>
                                @php
                                    $activeParticipants = \App\Models\Participant::active()->count();
                                @endphp
                                <span class="badge-count">{{ $activeParticipants }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('participants.index', ['status' => 'inactive']) }}" class="menu-link">
                                <i class="fas fa-times-circle menu-icon"></i>
                                <span class="menu-text">Inativos</span>
                                @php
                                    $inactiveParticipants = \App\Models\Participant::where('active', false)->count();
                                @endphp
                                @if($inactiveParticipants > 0)
                                <span class="badge-count">{{ $inactiveParticipants }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Entregas -->
                @if(auth()->user()->hasPermission('deliveries.view'))
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="toggleSubmenu(this)">
                        <i class="fas fa-truck menu-icon"></i>
                        <span class="menu-text">Entregas</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('deliveries.index') }}" class="menu-link {{ request()->routeIs('deliveries.index') ? 'active' : '' }}">
                                <i class="fas fa-list menu-icon"></i>
                                <span class="menu-text">Todas as Entregas</span>
                                @php
                                    $totalDeliveries = \App\Models\Delivery::count();
                                @endphp
                                <span class="badge-count">{{ $totalDeliveries }}</span>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('deliveries.create'))
                        <li>
                            <a href="{{ route('deliveries.create') }}" class="menu-link {{ request()->routeIs('deliveries.create') ? 'active' : '' }}">
                                <i class="fas fa-plus menu-icon"></i>
                                <span class="menu-text">Nova Entrega</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('deliveries.index') }}?status=scheduled" class="menu-link">
                                <i class="fas fa-clock menu-icon"></i>
                                <span class="menu-text">Agendadas</span>
                                @php
                                    $scheduledDeliveries = \App\Models\Delivery::where('status', 'scheduled')->count();
                                @endphp
                                @if($scheduledDeliveries > 0)
                                <span class="badge-count">{{ $scheduledDeliveries }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('deliveries.index') }}?status=in_progress" class="menu-link">
                                <i class="fas fa-play menu-icon"></i>
                                <span class="menu-text">Em Andamento</span>
                                @php
                                    $inProgressDeliveries = \App\Models\Delivery::where('status', 'in_progress')->count();
                                @endphp
                                @if($inProgressDeliveries > 0)
                                <span class="badge-count">{{ $inProgressDeliveries }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('deliveries.index') }}?status=completed" class="menu-link">
                                <i class="fas fa-check menu-icon"></i>
                                <span class="menu-text">Concluídas</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Registros de Entrega -->
                @if(auth()->user()->hasPermission('delivery_records.view'))
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="toggleSubmenu(this)">
                        <i class="fas fa-clipboard-list menu-icon"></i>
                        <span class="menu-text">Registros</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-history menu-icon"></i>
                                <span class="menu-text">Histórico Completo</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-calendar-day menu-icon"></i>
                                <span class="menu-text">Entregas do Mês</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-user-clock menu-icon"></i>
                                <span class="menu-text">Ausências</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Relatórios -->
                @if(auth()->user()->hasPermission('reports.view'))
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="toggleSubmenu(this)">
                        <i class="fas fa-chart-bar menu-icon"></i>
                        <span class="menu-text">Relatórios</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-chart-line menu-icon"></i>
                                <span class="menu-text">Estatísticas</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-file-pdf menu-icon"></i>
                                <span class="menu-text">Relatório Mensal</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-file-excel menu-icon"></i>
                                <span class="menu-text">Exportar Excel</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Administração -->
                @if(auth()->user()->hasPermission('users.view'))
                <li class="menu-item">
                    <a href="#" class="menu-link" onclick="toggleSubmenu(this)">
                        <i class="fas fa-cogs menu-icon"></i>
                        <span class="menu-text">Administração</span>
                        <i class="fas fa-chevron-right menu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('users.index') }}" class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <i class="fas fa-user-cog menu-icon"></i>
                                <span class="menu-text">Usuários</span>
                                @php
                                    $totalUsers = \App\Models\User::count();
                                @endphp
                                <span class="badge-count">{{ $totalUsers }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-shield-alt menu-icon"></i>
                                <span class="menu-text">Permissões</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-database menu-icon"></i>
                                <span class="menu-text">Backup</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-link">
                                <i class="fas fa-cog menu-icon"></i>
                                <span class="menu-text">Configurações</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>

            <!-- User Info -->
            <div class="user-info d-flex align-items-center">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <p class="user-name">{{ Auth::user()->name }}</p>
                    <p class="user-role">
                        @if(Auth::user()->hasRole('administrator'))
                            Administrador
                        @elseif(Auth::user()->hasRole('operator'))
                            Operador
                        @else
                            Participante
                        @endif
                    </p>
                </div>
            </div>
        </nav>
        @endauth

        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Top Navbar -->
            <div class="top-navbar d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="mobile-toggle me-3" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h5 class="mb-0">
                        @yield('page-title', 'Dashboard')
                    </h5>
                </div>

                @auth
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Sair
                            </a>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>

            <!-- Content Area -->
            <div class="content-area">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endauth
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        }

        function toggleSubmenu(element) {
            const submenu = element.nextElementSibling;
            const menuItem = element.parentElement;

            // Close other open submenus
            document.querySelectorAll('.submenu.show').forEach(sub => {
                if (sub !== submenu) {
                    sub.classList.remove('show');
                    sub.parentElement.classList.remove('open');
                }
            });

            // Toggle current submenu
            submenu.classList.toggle('show');
            menuItem.classList.toggle('open');
        }

        // Auto-open submenu if child is active
        document.addEventListener('DOMContentLoaded', function() {
            const activeLink = document.querySelector('.submenu .menu-link.active');
            if (activeLink) {
                const submenu = activeLink.closest('.submenu');
                const parentMenuItem = submenu.previousElementSibling.parentElement;

                submenu.classList.add('show');
                parentMenuItem.classList.add('open');
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const toggle = document.querySelector('.mobile-toggle');

                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
