<aside class="main-sidebar sidebar-dark-primary elevation-4 dashboard_sidebar">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('agent.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang('lang.dashboard')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            @lang('lang.offers')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('agent.properties.csv-upload') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.upload csv')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agent.properties.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.add')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agent.properties.all') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.all')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agent.change-email') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>@lang('lang.change email')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agent.change-password') }}" class="nav-link">
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
