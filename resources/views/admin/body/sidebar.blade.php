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

            <!-- Admin Dropdown -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#adminMenu" role="button" aria-expanded="false"
                    aria-controls="adminMenu">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Admin</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="adminMenu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Manage Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                    </ul>
                </div>
            </li>

            <!-- Supervisor Dropdown -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#supervisorMenu" role="button"
                    aria-expanded="false" aria-controls="supervisorMenu">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Supervisor</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="supervisorMenu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('interns') }}">
                                Manage Interns</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
                    </ul>
                </div>
            </li>

            <!-- Interns Dropdown -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#internsMenu" role="button" aria-expanded="false"
                    aria-controls="internsMenu">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">Interns</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="internsMenu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Manage Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Tasks</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
