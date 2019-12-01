<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light text-center">Health Care</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/maledoc.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Super Admin</a>
                <small class="text-white">{{ auth()->user()->email }}</small>
            </div>
        </div>

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(auth()->user()->role == 'admin')
                    <li class="nav-item has-treeview menu-open">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="{{ route('appointments.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>
                                Appointments
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="{{ route('orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Doctors</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('doctors.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p>Doctors List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('doc.notify') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p>Unverified doctors List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Lists View
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('departments.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p>Departments</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p>Products Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p>Products List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Reports
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('sales') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('appointments.report') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Appointments</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
