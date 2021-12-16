<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('/app-assets/images/bunga.png')}}" alt="icon" height="55">                       
                    <h2 class="brand-text">Kembyang Isun</h2>
                </a></li>
            {{-- <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li> --}}
        </ul>
    </div>
    <br><br>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span></a>
                    </li>
                    <li class="active"><a class="d-flex align-items-center" href="dashboard-ecommerce.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">eCommerce</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li> --}}
            <li class=" nav-item {{ Request::segment(2) === 'dashboard' ? 'active' : null }}"><a class="d-flex align-items-center" href="<?=url('seller/dashboard')?>"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Dashboard</span></a>
            </li>
            <li class=" nav-item {{ Request::segment(2) === 'penjualan' ? 'active' : null }}"><a class="d-flex align-items-center" href="<?=url('seller/penjualan')?>"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Data Penjualan</span></a>
            </li>
            <li class=" nav-item {{ Request::segment(2) === 'produk' ? 'active' : null }}"><a class="d-flex align-items-center" ><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Produk</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center " href="<?=url('seller/produk')?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Data Produk</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="<?=url('seller/kategori')?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Advanced">Kategori</span></a>
                        </li>
                    </ul>
            </li>
            <li class=" nav-item {{ Request::segment(2) === 'data-supplier' ? 'active' : null }}"><a class="d-flex align-items-center" href="<?=url('seller/data-supplier')?>"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Calendar">Data Supplier</span></a>
            </li>
            <li class=" nav-item {{ Request::segment(2) === 'laporan' ? 'active' : null }}"><a class="d-flex align-items-center" href="<?=url('seller/laporan')?>"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Kanban">Laporan</span></a>
            </li>
     
        </ul>
    </div>
</div>