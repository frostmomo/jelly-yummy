<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/trb.png" class="navbar-brand-img" alt="...">
            <h3 style="color:grey;">Tirta Rahayu</h3>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">    
                    </div>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-yellow"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jurnal') }}">
                        <i class="fa fa-book text-yellow"></i> {{ __('Jurnal') }}
                    </a>
                </li>
            </ul>
            <hr class="my-3">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#transaksi-collapse" role="button" aria-expanded="false" aria-controls="transaksi-collapse">
                        <i class="fa fa-folder text-yellow"></i> {{ __('Transaksi') }}
                    </a>
                    <div class="collapse" id="transaksi-collapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('penjualan') }}">
                                    <i class="fa fa-shopping-cart text-yellow"></i> {{ __('Penjualan') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pembelian') }}">
                                    <i class="fa fa-shopping-cart text-yellow"></i> {{ __('Pembelian') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <hr class="my-3">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#inventory-collapse" role="button" aria-expanded="false" aria-controls="inventory-collapse">
                        <i class="fa fa-folder text-yellow"></i> {{ __('Inventori') }}
                    </a>
                    <div class="collapse" id="inventory-collapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('produk-beli') }}">
                                    <i class="fa fa-cart-plus text-yellow"></i></i> {{ __('Produk Beli') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('produk-jual') }}">
                                    <i class="fa fa-cart-arrow-down text-yellow"></i></i> {{ __('Produk Jual') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kategori-beli') }}">
                                    <i class="fa fa-table text-yellow"></i></i> {{ __('Kategori Produk Beli') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kategori-jual') }}">
                                    <i class="fa fa-table text-yellow"></i></i> {{ __('Kategori Produk Jual') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <hr class="my-3">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#master-data-collapse" role="button" aria-expanded="false" aria-controls="master-data-collapse">
                        <i class="fa fa-folder text-yellow"></i> {{ __('Master Data') }}
                    </a>
                    <div class="collapse" id="master-data-collapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user') }}">
                                    <i class="ni ni-single-02 text-yellow"></i> {{ __('User') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('salesman') }}">
                                    <i class="ni ni-single-02 text-yellow"></i> {{ __('Salesman') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer') }}">
                                    <i class="ni ni-single-02 text-yellow"></i> {{ __('Customer') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('supplier') }}">
                                    <i class="ni ni-single-02 text-yellow"></i> {{ __('Supplier') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('akun') }}">
                                    <i class="ni ni-single-02 text-yellow"></i> {{ __('Akun') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
