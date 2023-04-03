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
            <li class="{{ Request::is('admin/prodi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.prodi.index') }}"><i class="fas fa-th-large"></i>
                    <span>Program Studi</span></a>
            </li>
            <li class="{{ Request::is('admin/gedung*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.gedung.index') }}"><i class="fas fa-th-large"></i>
                    <span>Gedung</span></a>
            </li>
            <li class="{{ Request::is('admin/ruangan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.ruangan.index') }}"><i class="fas fa-th-large"></i>
                    <span>Ruangan</span></a>
            </li>
            <li class="{{ Request::is('admin/dosen*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dosen.index') }}"><i class="fas fa-th-large"></i>
                    <span>Dosen</span></a>
            </li>
            <li class="{{ Request::is('admin/mahasiswa*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.mahasiswa.index') }}"><i class="fas fa-th-large"></i>
                    <span>Mahasiswa</span></a>
            </li>
            <li class="{{ Request::is('admin/matakuliah*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.matakuliah.index') }}"><i class="fas fa-th-large"></i>
                    <span>Matakuliah</span></a>
            </li>
            <li class="{{ Request::is('admin/tahun_akademik*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.tahun_akademik.index') }}"><i class="fas fa-th-large"></i>
                    <span>Tahun Akademik</span></a>
            </li>
            <li class="{{ Request::is('admin/krs*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.krs.index') }}"><i class="fas fa-th-large"></i>
                    <span>Pengajuan KRS</span></a>
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