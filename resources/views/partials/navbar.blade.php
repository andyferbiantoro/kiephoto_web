<ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
     <li class="dropdown nav-item {{ (request()->is('/')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('dashboard') }}">
            <i data-feather="home"></i>
            <span>Beranda</span>
        </a>
    </li>
    <li class="dropdown nav-item {{ (request()->is('paket*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('paket') }}">
            <i data-feather="copy"></i>
            <span>Paket</span>
        </a>
    </li>

     <li class="dropdown nav-item {{ (request()->is('tentang*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('tentang') }}">
            <i data-feather="alert-circle"></i>
            <span>Tentang</span>
        </a>
    </li>

     <li class="dropdown nav-item {{ (request()->is('panduan*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('panduan') }}">
            <i data-feather="help-circle"></i>
            <span>Panduan</span>
        </a>
    </li>
    @auth
    <li class="dropdown nav-item {{ (request()->is('pelanggan_riwayat_pemesanan*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('pelanggan_riwayat_pemesanan') }}">
            <i data-feather="shopping-cart"></i>
            <span>Riwayat Pemesanan</span>
        </a>
    </li>

    <li class="dropdown nav-item {{ (request()->is('pelanggan_profil*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('pelanggan_profil') }}">
            <i data-feather="user"></i>
            <span>Profil</span>
        </a>
    </li>

     <li class="dropdown nav-item {{ (request()->is('logout-pelanggan*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center text-danger" href="{{ route('logout-pelanggan') }}">
            <i data-feather="log-out"></i>
            <span>Logout</span>
        </a>
    </li>
    @endauth
</ul>