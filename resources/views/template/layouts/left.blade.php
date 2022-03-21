<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="d-flex justify-content-center">

    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand-link mt-3 pb-3 mb-3 d-flex justify-content-center">
            <a href="/">
                {{-- <img src="{{ asset('vendors/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
                <strong><span class="brand-image font-weight-light">SIMIT </span></strong>
            </a>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div>

        {{-- <!-- Sidebar Menu --> tambah menu di sini --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if(Auth::user()->level == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Admin</p>
                    </a>
                </li>
                @endif
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Master
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('company.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Company</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('location.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Location</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('division.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Division</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manufacture.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manufacture</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('asset.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('unit.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Supplier</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('permintaan.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                    </a>
                </li> --}}
                @if(Auth::user()->company_id == 1)
                <li class="nav-item">
                    <a href="{{ route('efrata_permintaan.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 2)
                <li class="nav-item">
                    <a href="{{ route('danliris_permintaan.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 3)
                <li class="nav-item">
                    <a href="{{ route('ag_permintaan.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                    </a>
                </li>
                @endif
                 {{-- <li class="nav-item">
                    <a href="{{ route('budget.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li> --}}
                @if (Auth::user()->company_id == 1)
                <li class="nav-item">
                    <a href="{{ route('efrata_budget.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 2)
                <li class="nav-item">
                    <a href="{{ route('danliris_budget.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 3)
                <li class="nav-item">
                    <a href="{{ route('ag_budget.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li>
                @endif

                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-wrench"></i>
                    <p>
                        Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('antrianservice.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Antrian Service</p>
                            </a>
                        </li> --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_antrianservice.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Antrian Service</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_antrianservice.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Antrian Service</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_antrianservice.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Antrian Service</p>
                            </a>
                        </li>
                        @endif

                        {{-- service_final --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_servicefinal.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Service Final</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_servicefinal.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Service Final</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_servicefinal.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Service Final</p>
                            </a>
                        </li>
                        @endif

                        {{-- analysis --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_analysis.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Analysis</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_analysis.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Analysis</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_analysis.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Analysis</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                
                {{-- <li class="nav-item">
                    <a href="{{ route('danliris_stocklist.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock Opname</p>    
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('danliris_stock.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Saldo Awal</p>    
                    </a>
                </li> --}}

                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fa fa-circle"></i>
                    <p>
                        Stock
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('danliris_stocklist.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stock Opname</p>    
                            </a>
                        </li>
        
                        <li class="nav-item">
                            <a href="{{ route('danliris_stock.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Saldo Awal</p>    
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fa fa-upload"></i>
                    <p>
                        Upload Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- rbt --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_rbt.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>RBT</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_rbt.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>RBT</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_rbt.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>RBT</p>
                            </a>
                        </li>
                        @endif
                        {{-- temperature/suhu --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_temperature.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Suhu</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_temperature.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Suhu</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_temperature.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Suhu</p>
                            </a>
                        </li>
                        @endif
                        {{-- Ups --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_ups.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ups</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_ups.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ups</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_ups.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ups</p>
                            </a>
                        </li>
                        @endif
                        {{-- Server --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_server.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Server</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_server.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Server</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_server.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Server</p>
                            </a>
                        </li>
                        @endif
                        {{-- pergantian user Komputer --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_change_pc_user.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User PC</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_change_pc_user.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User PC</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_change_pc_user.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User PC</p>
                            </a>
                        </li>
                        @endif
                        {{-- pergantian user email --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_change_email_user.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User Email</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('dl_change_email_user.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User Email</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_change_email_user.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User Email</p>
                            </a>
                        </li>
                        @endif
                        {{-- pergantian Wifi --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_change_wifi.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian Wifi</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_change_wifi.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian Wifi</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_change_wifi.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian Wifi</p>
                            </a>
                        </li>
                        @endif
                        {{-- kalibrasi alat --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_kalibrasi_alat.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kalibrasi Alat</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_kalibrasi_alat.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kalibrasi Alat</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_kalibrasi_alat.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kalibrasi Alat</p>
                            </a>
                        </li>
                        @endif
                        {{-- serah terima --}}
                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_serah_terima.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Serah Terima</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_serah_terima.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Serah Terima</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_serah_terima.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Serah Terima</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                {{-- <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fa fa-upload"></i>
                    <p>
                        Upload Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('rbt.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>RBT</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('temperature.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Suhu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ups.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ups</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('server.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Server</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('change_pc_user.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User PC</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('change_email_user.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian User Email</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('change_wifi.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pergantian Wifi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kalibrasi_alat.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kalibrasi Alat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('serah_terima.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Serah Terima</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('pemasukan.index') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemasukan</p>
                    </a>
                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
