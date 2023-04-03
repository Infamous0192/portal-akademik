<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('mahasiswa.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}"><i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('mahasiswa/krs*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.krs.index') }}"><i class="fas fa-th-large"></i>
                    <span>Rencana Studi</span></a>
            </li>
            <li class="{{ Request::is('mahasiswa/hasil*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.hasil.index') }}"><i class="fas fa-th-large"></i>
                    <span>Hasil Studi</span></a>
            </li>
            <li class="{{ Request::is('mahasiswa/jadwal/kuliah') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.jadwal.kuliah') }}"><i class="fas fa-th-large"></i>
                    <span>Jadwal Kuliah</span></a>
            </li>
            <li class="{{ Request::is('mahasiswa/jadwal/akademik') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.jadwal.akademik') }}"><i class="fas fa-th-large"></i>
                    <span>Jadwal Akademik</span></a>
            </li>
        </ul>
    </aside>
</div>