<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                    Privileges
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Auth::check() && Auth::user()->isAdmin())
                <li class="nav-item">
                    <a href="{{url('/user')}}" class="nav-link menu">
                        <i class="far fa-user nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/controller')}}" class="nav-link menu">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Controllers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/role')}}" class="nav-link menu">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/group_menu')}}" class="nav-link menu">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Grup Menu</p>
                    </a>
                </li> 
                @endif
                
            </ul> 
        </li>
        <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                    Organizations
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Auth::check() && Auth::user()->isAdmin()) 
                <li class="nav-item">
                    <a href="{{url('/position')}}" class="nav-link menu">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Position</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/employee')}}" class="nav-link menu">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee</p>
                    </a>
                </li>  
                <li class="nav-item">
                    <a href="{{url('/department')}}" class="nav-link menu">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Department</p>
                    </a>
                </li>  
                @endif
                
            </ul> 
        </li>
        <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                    Finance
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{url('/income')}}" class="nav-link menu">
                            <i class="far fa-user nav-icon"></i>
                            <p>Pendapatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/expenditure')}}" class="nav-link menu">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengeluaran</p>
                        </a>
                    </li> 
                    @endif
                @endif
            </ul> 
        </li>
        <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Asset
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Auth::check() && Auth::user()->isAdmin())
                <li class="nav-item">
                    <a href="{{url('/asset_type')}}" class="nav-link menu">
                        <i class="far fa-user nav-icon"></i>
                        <p>Jenis Asset</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{url('/asset_status')}}" class="nav-link menu">
                        <i class="far fa-user nav-icon"></i>
                        <p>Status Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/asset')}}" class="nav-link menu">
                        <i class="far fa-user nav-icon"></i>
                        <p>Asset</p>
                    </a>
                </li> 
                
                @endif
                
            </ul> 
        </li>
        <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                    Events
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Auth::check() && Auth::user()->isAdmin())
                <li class="nav-item">
                    <a href="{{url('/event_type')}}" class="nav-link menu">
                        <i class="far fa-user nav-icon"></i>
                        <p>Jenis Kegiatan</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{url('/event')}}" class="nav-link menu">
                        <i class="far fa-user nav-icon"></i>
                        <p>Kegiatan</p>
                    </a>
                </li> 
                
                @endif
                
            </ul> 
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link" onclick="document.getElementById('logout').submit();this.onclick=null;">
                  
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                    Log Out 
                </p>
            </a>
            <form id="logout" action="{{ url('/logout')}}" method="post">
                @csrf
            </form>
        </li>
         
    </ul>
</nav>
<!-- /.sidebar-menu -->