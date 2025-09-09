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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

        .sidebar-header .collapse-btn {
            position: absolute;
            top: 1.5rem;
            right: 1rem;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .collapse-btn {
            transform: rotate(180deg);
        }

        .sidebar.collapsed .menu-text,
        .sidebar.collapsed .sidebar-header h4 {
            display: none;
        }

        .main-content {
            margin-left: 280px;
            transition: all 0.3s ease;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            margin: 0;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .menu-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
        }

        .menu-link.active {
            background-color: rgba(255,255,255,0.15);
            border-left-color: #fff;
            color: white;
        }

        .menu-icon {
            min-width: 20px;
            margin-right: 1rem;
            text-align: center;
        }

        .menu-text {
            flex: 1;
        }

        .menu-arrow {
            transition: transform 0.3s ease;
        }

        .menu-link[aria-expanded="true"] .menu-arrow {
            transform: rotate(90deg);
        }

        .submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: rgba(0,0,0,0.1);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .submenu.show {
            max-height: 500px;
        }

        .submenu .menu-link {
            padding-left: 3.5rem;
            font-size: 0.9rem;
        }

        .counter-badge {
            background-color: rgba(255,255,255,0.2);
            color: white;
            border-radius: 12px;
            padding: 0.2rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: auto;
        }

        .user-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            background-color: rgba(0,0,0,0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }

        .user-role {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            margin: 0;
        }

        .logout-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.8);
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .logout-btn:hover {
            color: white;
        }

        .content-header {
            background: white;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .content-header h2 {
            margin: 0;
            color: #2c3e50;
            font-weight: 600;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0.5rem 0 0 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: #6c757d;
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
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
                background: #667eea;
                color: white;
                border: none;
                padding: 0.5rem;
                border-radius: 4px;
                cursor: pointer;
            }
        }

        .mobile-toggle {
            display: none;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Mobile Toggle -->
        <button class="mobile-toggle d-md-none" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <!-- Header -->
            <div class="sidebar-header">
                <h4>{{ config('app.name', 'Solidariedade') }}</h4>
                <button class="collapse-btn d-none d-md-block" onclick="collapseSidebar()">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <!-- Menu -->
            <ul class="sidebar-menu">
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ route('home') }}" class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt menu-icon"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Participantes -->
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
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('participants.create') }}" class="menu-link {{ request()->routeIs('participants.create') ? 'active' : '' }}">
                                <i class="fas fa-plus menu-icon"></i>
                                <span class="menu-text">Cadastrar Novo</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Entregas -->
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
                                <span class="menu-text">Gerenciar Entregas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('deliveries.create') }}" class="menu-link {{ request()->routeIs('deliveries.create') ? 'active' : '' }}">
                                <i class="fas fa-plus menu-icon"></i>
                                <span class="menu-text">Nova Entrega</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Usuários -->
                <li class="menu-item">
                    <a href="{{ route('users.index') }}" class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="fas fa-user-cog menu-icon"></i>
                        <span class="menu-text">Usuários</span>
                    </a>
                </li>
            </ul>

            <!-- User Info -->
            <div class="user-info">
                <div class="d-flex align-items-center">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <p class="user-name">{{ Auth::user()->name }}</p>
                        <p class="user-role">Administrador</p>
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

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            @if(isset($pageTitle) || View::hasSection('page-title'))
                <div class="content-header">
                    <h2>{{ $pageTitle ?? View::getSection('page-title') }}</h2>
                    @if(View::hasSection('breadcrumb'))
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    @endif
                </div>
            @endif

            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        function collapseSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        function toggleSubmenu(element) {
            const submenu = element.nextElementSibling;
            const arrow = element.querySelector('.menu-arrow');

            if (submenu) {
                submenu.classList.toggle('show');
                element.setAttribute('aria-expanded', submenu.classList.contains('show'));
            }
        }

        // Auto close mobile sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.querySelector('.mobile-toggle');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !mobileToggle.contains(event.target)) {
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
