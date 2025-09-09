<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .sidebar-header .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            float: right;
            margin-top: -35px;
            margin-right: 5px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu .menu-item {
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-menu .menu-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar-menu .menu-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            text-decoration: none;
        }

        .sidebar-menu .menu-link.active {
            color: white;
            background: rgba(255,255,255,0.15);
            border-right: 3px solid #ffd700;
        }

        .sidebar-menu .menu-icon {
            width: 20px;
            margin-right: 12px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar-menu .menu-text {
            font-weight: 500;
            font-size: 0.95rem;
        }

        .sidebar-menu .submenu {
            background: rgba(0,0,0,0.1);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .sidebar-menu .submenu.show {
            max-height: 300px;
        }

        .sidebar-menu .submenu .menu-link {
            padding: 0.75rem 1.5rem 0.75rem 3rem;
            font-size: 0.9rem;
        }

        .sidebar-menu .menu-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-menu .menu-item.open .menu-arrow {
            transform: rotate(90deg);
        }

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
