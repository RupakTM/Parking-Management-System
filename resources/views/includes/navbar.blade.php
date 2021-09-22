<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
    </ul>
    <form action="{{route('payment.search')}}" method="POST" class="form-inline ml-3">
        @csrf
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" name="invoice_id" id="invoice_id" placeholder="Search" aria-label="Search">
            <div class="input-group-append" id="iconmessage">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-info">
                        <span class="messagehover">
                            Search by invoice number.
                            For example, type: {{date('Y')}}-0001
                        </span>
                    </i>
                </button>

            </div>
        </div>
    </form>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(auth()->user()->image)
                    <img src="{{asset('uploads/images/user/'.auth()->user()->image)}}" width="32px" height="32px" style="border-radius:50%">
                @else
                    <img src="{{asset('uploads/images/user/1614519135_person icon.png')}}" width="32px" height="32px" style="border-radius:50%">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('user.show',auth()->user()->id)}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a href="{{route('setting.edit')}}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-cog"></i>
                    <span>
                        Setting
                    </span>
                </a>
                {{-- Logout --}}
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
