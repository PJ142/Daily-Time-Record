<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand"> Noble<span>UI</span> </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Pages</li>

            <li class="nav-item">
                <a href="{{ route('manage.users') }}" class="nav-link">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Manage Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('interns') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manage Interns</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dtr.intern') }}" class="nav-link">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">Manage DTR</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
