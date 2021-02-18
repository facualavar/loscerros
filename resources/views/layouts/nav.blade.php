 <nav id="main-menu-navigation" class="navigation-main">
        <div class="nav-item has-sub">
            <a><i class="ik ik-users"></i><span>Usuarios</span></a>
            <div class="submenu-content">
                <a href="{{url('roles')}}" class="menu-item">Roles</span></a>
                <a href="{{url('usuarios')}}" class="menu-item">Usuarios</span></a>
            </div>
        </div>


        <div class="nav-item has-sub">
            <a><i class="ik ik-clipboard"></i><span>Informes</span></a>
            <div class="submenu-content">
                <a href="{{route('informes')}}" class="menu-item">Registro de informes</a>
                <a href="{{route('listado')}}" class="menu-item">Listar informes</a>
            </div>
        </div>

        <div class="nav-item has-sub">
            <a><i class="fa fa-user"></i><span>Pacientes</span></a>
            <div class="submenu-content">
                <a href="{{route('pacientes')}}" class="menu-item">Listado</a>
                {{-- <a href="pages/form-addon.html" class="menu-item">Historial</a> --}}
            </div>
        </div>

        <div class="nav-item">
            <a href="{{route('doctores')}}"><i class="fa fa-user-md"></i><span>Doctores</span></a>
        </div>

        <div class="nav-item has-sub">
            <a><i class="ik ik-calendar"></i><span>Ordenes</span></a>
            <div class="submenu-content">
                <a href="{{route('nacionales')}}" class="menu-item">Obras</a>
            </div>
            <div class="submenu-content">
                <a href="{{route('particulares')}}" class="menu-item">Particulares</a>
            </div>
            {{--div class="submenu-content">
                <a href="{{route('pami')}}" class="menu-item">PAMI</a>
            </div>
            <div class="submenu-content">
                <a href="{{route('nacionales')}}" class="menu-item">Nacionales</a>
            </div>
            
            <div class="submenu-content">
                <a href="{{route('deudores')}}" class="menu-item">Deudores</a>
            </div>--}}
        </div>

        <div class="nav-item has-sub">
            <a><i class="fa fa-heartbeat"></i><span>Obras Sociales</span></a>
            <div class="submenu-content">
                <a href="{{route('obrassociales')}}" class="menu-item">Listado</a>
                {{-- <a href="{{route('obraMes')}}" class="menu-item">Ordenes por mes</a> --}}
            </div>
        </div>

        <div class="nav-item has-sub">
            <a><i class="fa fa-flask"></i><span>Analisis</span></a>
            <div class="submenu-content">
                <a href="{{route('analisis')}}" class="menu-item">Agregar</a>
                <a href="{{route('analisisListado')}}" class="menu-item">Listado</a>
            </div>
        </div>

</nav>
