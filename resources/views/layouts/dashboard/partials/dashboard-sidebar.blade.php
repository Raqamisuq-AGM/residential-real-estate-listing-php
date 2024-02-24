<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #0c4b36 !important">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang('lang.dashboard')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            @lang('lang.properties')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.properties.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.add')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.properties.all') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.all')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.properties.pending') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.pending')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.properties.approved') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.approved')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.properties.declined') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.declined')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.change-password') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>@lang('lang.change password')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>@lang('lang.logout')</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
