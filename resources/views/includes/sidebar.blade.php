<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-color">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link navbar-orange">
        @if($data['setting']->logo)
            <img src="{{asset('uploads/images/settings/'.$data['setting']->logo)}}" alt="Logo" class="brand-image img-circle" style="opacity: .8">
        @else
            <img src="{{asset('public_images/logo.png')}}" alt="Logo" class="brand-image img-circle" style="opacity: .8">
        @endif
        <span class="brand-text font-weight-light custom-text-color-black"><strong>{{$data['setting']->name}}</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth()->user()->image)
                    <img src="{{asset('uploads/images/user/'.auth()->user()->image)}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{asset('uploads/images/user/1614519135_person icon.png')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{route('user.show',auth()->user()->id)}}" class="d-block custom-text-color-black">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="av-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header"><b>OPERATIONS</b></li>
                <li class="nav-item">
                    <a href="{{route('parking.create')}}" class="nav-link">
                        <i class="nav-icon fa fa-plus" aria-hidden="true"></i>
                        <p>
                            Add
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('parking.exit')}}" class="nav-link">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>
                            Exit
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('parking.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            List
                        </p>
                    </a>
                </li>
                <li class="nav-header"><b>ADMIN SECTION</b></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('module.index')}}" class="nav-link">
                                <i class="fa fa-dot-circle nav-icon"></i>
                                <p>Module</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('permission.index')}}" class="nav-link">
                                <i class="fa fa-dot-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('role.index')}}" class="nav-link">
                                <i class="fa fa-dot-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link">
                                <i class="fa fa-dot-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Staff Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('staff.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('staff.index')}}" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Parking Slot Mgmt
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('parkingslot.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('parkingslot.index')}}" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('customer.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-user-circle" aria-hidden="true"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('payment.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-money-bill-alt"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('parking.report')}}" class="nav-link">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>
                            Parking Report
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('setting.edit')}}" class="nav-link">
                        <i class="nav-icon fas fa-fw fa-cog"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
