
<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">   
                <li class="nav-item {{(request()->is('admin_index')) ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{ route('admin_index') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
                </li>
                
                <li class="nav-item {{(request()->is('admin_kelola_pelanggan')) ? 'active' : ''}} ">
                    <a class="d-flex align-items-center" href="{{ route('admin_kelola_pelanggan') }}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Pelanggan</span></a>
                </li>

                <li class="nav-item {{(request()->is('admin_kelola_paket')) ? 'active' : ''}} ">
                    <a class="d-flex align-items-center" href="{{ route('admin_kelola_paket') }}"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Paket</span></a>
                </li>

                <li class="nav-item {{(request()->is('admin_kelola_portofolio')) ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{ route('admin_kelola_portofolio') }}"><i data-feather="layout"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Portofolio</span></a>
                </li>

                <li class="nav-item {{(request()->is('admin_kelola_pemesanan')) ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{ route('admin_kelola_pemesanan') }}"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Pemesanan</span></a>
                </li>

                <li class="nav-item {{(request()->is('admin_kelola_laporan_transaksi')) ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{ route('admin_kelola_laporan_transaksi') }}"><i data-feather="file"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Laporan Transaksi</span></a>
                </li>

                <!-- <li class="nav-item {{(request()->is('admin_kelola_pengaturan')) ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{ route('admin_kelola_pengaturan') }}"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Pengaturan</span></a>
                </li> -->

                <li class="nav-item {{(request()->is('admin_ubah_password')) ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{ route('admin_ubah_password') }}"><i data-feather="key"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Ubah Password</span></a>
                </li>

                <li class="nav-item {{(request()->is('logout-admin')) ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{ route('logout-admin') }}"><i data-feather="log-out"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Logout</span></a>
                </li>





                <!-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="app-user-list.html"><i data-feather="circle"></i><span class="menu-item" data-i18n="List">List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-user-view.html"><i data-feather="circle"></i><span class="menu-item" data-i18n="View">View</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-user-edit.html"><i data-feather="circle"></i><span class="menu-item" data-i18n="Edit">Edit</span></a>
                        </li>
                    </ul>
                </li> -->
            </ul>