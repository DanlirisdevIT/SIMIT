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
                        <a href="{{ route('manufacture.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manufacture</p>
                        </a>
                    </li>
                </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
