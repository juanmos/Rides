<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <span class="b-title"><img src="{{asset('assets/images/Lupp.png')}}" style="max-width:74%"/></span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item {{(Route::currentRouteName()=='admin.index')?'active':''}}">
                    <a href="{{route('home')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Inicio</span></a>
                </li>
                @if(Auth::user()->hasRole('Administradores'))
                <li  class="nav-item {{(Route::currentRouteName()=='admin.drivers.index')?'active':''}}">
                    <a href="{{route('admin.drivers.index')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-car"></i></span><span class="pcoded-mtext">Conductores</span></a>
                </li>
                {{--  <li data-username="Table bootstrap datatable footable" class="nav-item">
                    <a href="{{route('hotel.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Hoteles</span></a>
                </li>
                
                <li class="nav-item pcoded-menu-caption">
                    <label>Administración</label>
                </li>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Administracion</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="{{route('usuario.index')}}" class="">Usuarios</a></li>
                        <li class=""><a href="{{route('aerolinea.index')}}" class="">Aerolineas</a></li>
                        <li class=""><a href="bc_breadcrumb-pagination.html" class="">Vuelos</a></li>
                    </ul>
                </li>  --}}
                @endif
                {{-- @if(Auth::user()->hasRole('Usuarios'))
                <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item">
                    <a href="{{route('driver.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clock"></i></span><span class="pcoded-mtext">Historial</span></a>
                </li>
                @endif
                 --}}
                <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-log-out"></i></span><span class="pcoded-mtext">Cerrar sesión</span></a>
                </li>
                {{-- 
                <li class="nav-item pcoded-menu-caption">
                    <label>Configuraciones</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item">
                    <a href="form_elements.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Partidos politicos</span></a>
                </li>
                <li data-username="Table bootstrap datatable footable" class="nav-item">
                    <a href="tbl_bootstrap.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Candidatos</span></a>
                </li>
                <li data-username="Table bootstrap datatable footable" class="nav-item">
                    <a href="tbl_bootstrap.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Puestos politicos</span></a>
                </li>
                <li data-username="Table bootstrap datatable footable" class="nav-item">
                    <a href="tbl_bootstrap.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Recintos electorales</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Chart & Maps</label>
                </li>
                <li data-username="Charts Morris" class="nav-item"><a href="chart-morris.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Chart</span></a></li>
                <li data-username="Maps Google" class="nav-item"><a href="map-google.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Maps</span></a></li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Pages</label>
                </li>
                <li data-username="Authentication Sign up Sign in reset password Change password Personal information profile settings map form subscribe" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="auth-signup.html" class="" target="_blank">Sign up</a></li>
                        <li class=""><a href="auth-signin.html" class="" target="_blank">Sign in</a></li>
                    </ul>
                </li>
                <li data-username="Sample Page" class="nav-item"><a href="sample-page.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>
                <li data-username="Disabled Menu" class="nav-item disabled"><a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="feather icon-power"></i></span><span class="pcoded-mtext">Disabled menu</span></a></li> --}}
            </ul>
        </div>
    </div>
</nav>