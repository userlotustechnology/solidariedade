<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="ti-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('deliveries.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('deliveries.index') }}">
                <i class="ti-truck menu-icon"></i>
                <span class="menu-title">Entregas</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Usuários</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('participants.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('participants.index') }}">
                <i class="ti-id-badge menu-icon"></i>
                <span class="menu-title">Participantes</span>
            </a>
        </li>
    </ul>
</nav>
