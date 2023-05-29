<aside class="main-sidebar sidebar-dark-primary elevation-3">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('storage/images/LOGO%20SISDA.png') }}" alt="LOGO%20SISDA.png" width="200"
            class="img-thumbnail ">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/item"
                                class="nav-link {{ Request::is('dashboard/item') ? 'active' : '' }}">
                                <span data-feather="layers"></span>
                                <p>Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                                <span data-feather="users"></span>
                                <p>Pengguna</p>
                            </a>
                        </li>
                        @can('SuperAdmin')
                            <li class="nav-item">
                                <a href="/categories" class="nav-link {{ Request::is('categories') ? 'active' : '' }}">
                                    <span data-feather="folder-plus"></span>
                                    <p>Kategori</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="nav-link px-3 bg-dark border-0">
                            logout <span data-feather="log-out" class="align-text-bottom"></span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
