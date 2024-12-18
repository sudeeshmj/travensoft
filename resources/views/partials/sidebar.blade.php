<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu mt-3">

            @if (auth()->user()->role == 1)
                <div class="nav">
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                </div>
                <div class="nav">
                    <a class="nav-link {{ Request::is('admin/departments') ? 'active' : '' }}"
                        href="{{ route('department.index') }}">
                        <div class="sb-nav-link-icon"><i class="far fa-building"></i></div>
                        Departments
                    </a>
                </div>

                <div class="nav">
                    <a class="nav-link {{ Request::is('admin/department-heads') ? 'active' : '' }}"
                        href="{{ route('department.head.index') }}">
                        <div class="sb-nav-link-icon"><i class="far fa-user"></i></div>
                        Department Heads
                    </a>
                </div>
            @endif


            @if (auth()->user()->role == 2)
                <div class="nav">
                    <a class="nav-link {{ Request::is('department/dashboard') ? 'active' : '' }}"
                        href="{{ route('department.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                </div>
                <div class="nav">
                    <a class="nav-link {{ Request::is('department/weekly-updates*') ? 'active' : '' }}"
                        href="{{ route('department.weekly-update.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Weekly Updates
                    </a>
                </div>
            @endif

            @if (auth()->user()->role == 3)
                <div class="nav">
                    <a class="nav-link {{ Request::is('employee/dashboard') ? 'active' : '' }}"
                        href="{{ route('employee.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                </div>
                <div class="nav">
                    <a class="nav-link {{ Request::is('employee/weekly-updates*') ? 'active' : '' }}"
                        href="{{ route('weekly-update.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Weekly Updates
                    </a>
                </div>
            @endif
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: {{ auth()->user()->name }}</div>
        </div>
    </nav>
</div>
