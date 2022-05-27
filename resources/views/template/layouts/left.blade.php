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
                    <a href="{{ route('dashboard') }}" class="nav-link">
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
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Permintaan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    @if(Auth::user()->company_name == 'Danliris' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('danliris_permintaan.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danliris Permintaan</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->company_name == 'Efrata' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('efrata_permintaan.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Efrata Permintaan</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->company_name == 'AG' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('ag_permintaan.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>AG Permintaan</p>
                            </a>
                        </li>
                    @endif
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Budget
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Auth::user()->company_name == 'Efrata' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('efrata_budget.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Efrata Budget</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'Danliris' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('danliris_budget.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danliris Budget</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'AG' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('ag_budget.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ag Budget</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <!-- @if(Auth::user()->company_id == 1)
                <li class="nav-item">
                    <a href="{{ route('efrata_permintaan.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 2)
                <li class="nav-item">
                    <a href="{{ route('danliris_permintaan.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 3)
                <li class="nav-item">
                    <a href="{{ route('ag_permintaan.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                    </a>
                </li>
                @endif -->
                 <!-- {{-- <li class="nav-item">
                    <a href="{{ route('budget.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li> --}} -->
                <!-- @if (Auth::user()->company_id == 1)
                <li class="nav-item">
                    <a href="{{ route('efrata_budget.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 2)
                <li class="nav-item">
                    <a href="{{ route('danliris_budget.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 3)
                <li class="nav-item">
                    <a href="{{ route('ag_budget.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Budget</p>
                    </a>
                </li>
                @endif -->

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
                        @if(Auth::user()->company_name == 'Efrata' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('efrata_antrianservice.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Antrian Service</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'Danliris' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('danliris_antrianservice.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Antrian Service</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'AG' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('ag_antrianservice.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Antrian Service</p>
                            </a>
                        </li>
                        @endif

                        {{-- Service tidak tercapai --}}
                        @if(Auth::user()->company_name == 'Efrata' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Service tidak tercapai</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'Danliris' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('danliris_service_tidak_tercapai.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Service tidak tercapai</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'AG' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Service tidak tercapai</p>
                            </a>
                        </li>
                        @endif

                        {{-- service_final --}}
                        @if(Auth::user()->company_name == 'Efrata' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('efrata_service_history.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>History Service</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'Danliris' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('danliris_service_history.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>History Service</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'AG' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('ag_service_history.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>History Service</p>
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

                        @if (Auth::user()->company_id == 1)
                        <li class="nav-item">
                            <a href="{{ route('efrata_stockopname.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stock Opname</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 2)
                        <li class="nav-item">
                            <a href="{{ route('danliris_stockopname.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stock Opname</p>
                            </a>
                        </li>
                        @elseif (Auth::user()->company_id == 3)
                        <li class="nav-item">
                            <a href="{{ route('ag_stockopname.index') }}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stock Opname</p>
                            </a>
                        </li>
                        @endif

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
                            <a href="{{ route('danliris_change_email_user.index') }}" class="nav-link ">
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
                <!-- {{-- <li class="nav-item">
                    <a href="{{ route('pemasukan.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemasukan</p>
                    </a>
                </li> --}} -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Pemasukan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Auth::user()->company_name == 'Efrata' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('efrata_pemasukan.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Efrata Pemasukan</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'Danliris' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('danliris_pemasukan.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danliris Pemasukan</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'AG' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('ag_pemasukan.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>AG Pemasukan</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Pengeluaran
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Auth::user()->company_name == 'efrata' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('efrata_pengeluaran.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Efrata Pengeluaran</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'Danliris' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('danliris_pengeluaran.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danliris Pengeluaran</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->company_name == 'AG' || is_null(Auth::user()->company_id))
                        <li class="nav-item">
                            <a href="{{ route('ag_pengeluaran.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>AG Pengeluaran</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <!-- @if(Auth::user()->company_id == 1)
                <li class="nav-item">
                    <a href="{{ route('efrata_pemasukan.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemasukan</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 2)
                <li class="nav-item">
                    <a href="{{ route('danliris_pemasukan.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemasukan</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 3)
                <li class="nav-item">
                    <a href="{{ route('ag_pemasukan.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemasukan</p>
                    </a>
                </li>
                @endif -->
                <!-- @if(Auth::user()->company_id == 1)
                <li class="nav-item">
                    <a href="{{ route('efrata_pengeluaran.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengeluaran</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 2)
                <li class="nav-item">
                    <a href="{{ route('danliris_pengeluaran.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengeluaran</p>
                    </a>
                </li>
                @elseif(Auth::user()->company_id == 3)
                <li class="nav-item">
                    <a href="{{ route('ag_pengeluaran.index') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengeluaran</p>
                    </a>
                </li>
                @endif -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
