<li class="nav-item dropdown d-block d-xl-none">
    <a class="nav-link dropdown-toggle btn-icon hide-arrow" href="javascript:void(0)"
        id="mobileMenuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="tf-icons navbar-icon ri-menu-2-line me-1"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="mobileMenuDropdown">
        <li><a class="dropdown-item" href="{{ route('proyectos.index') }}"><i class="menu-icon ri-home-smile-line"></i>Proyectos</a></li>
        <li><a class="dropdown-item" href="{{ route('almacen.index') }}"><i class="menu-icon ri-store-line"></i>Almacén</a></li>
        <li><a class="dropdown-item" href="{{ route('requisiciones.index') }}"><i class="menu-icon ri-archive-stack-line"></i>Requisiciones</a></li>
        <li><a class="dropdown-item" href="{{ route('cotizaciones.index') }}"><i class="menu-icon ri-mail-send-fill"></i>Cotizaciones</a></li>
        <li><a class="dropdown-item" href="{{ route('pagos.index') }}"><i class="menu-icon ri-money-dollar-circle-line"></i>Pagos</a></li>
    </ul>
</li>
<div class="navbar-nav-right d-flex" id="navbar-collapse">
    <div class="navbar-nav align-items-center ms-auto">
        <ul class="navbar-nav flex-row align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link btn-icon dropdown-toggle hide-arrow dropdown me-1 me-xl-0" href="javascript:void(0)"
                    id="navbarDropdown1" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="tf-icons navbar-icon ri-user-3-line me-1"></i> </a>
                <ul class="dropdown-menu " aria-labelledby="dropdownMenuOffset">
                    <li class="nav-item"><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                class="menu-icon ri-user-3-line"></i>Perfil</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                <i class="tf-icons navbar-icon ri-logout-box-line me-1"></i>Cerrar session</a>
                        </form>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle  btn-icon hide-arrow dropstart " href="javascript:void(0)"
                    id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="tf-icons navbar-icon ri-settings-3-line me-1"></i></a>
                <ul class="dropdown-menu ">
                    <li class="nav-item"><a class="dropdown-item" href="{{ route('clientes.index') }}"><i
                                class="menu-icon ri-group-line"></i>Clientes</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="{{ route('proveedores.index') }}"><i
                                class="menu-icon ri-user-community-line"></i>Proveedores</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="{{ route('tipomaterial.index') }}"><i
                                class="menu-icon ri-box-2-fill"></i>Tipo Material</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="{{ route('unidades.index') }}"><i
                                class="menu-icon ri-ruler-line"></i>Unidades de Medida</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
