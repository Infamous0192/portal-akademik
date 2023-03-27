<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('admin/fakultas*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.fakultas.index') }}"><i class="fas fa-th-large"></i>
                    <span>Fakultas</span></a>
            </li>
            {{-- <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li> --}}
        </ul>
    </aside>
</div>