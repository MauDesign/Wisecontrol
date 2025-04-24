<div class="menu-block my-2 d-flex align-items-center">
    <div class=" mb-2">
    <a href="#" class="app-brand-link gap-2">
        <img alt="Logo" class="brand image-fluid"
            src="{{ asset('assets/img/logo-wiseControl-blanco.png') }}" style="width: 10rem;">
    </a>
        </div>
    <p>¡Hola de nuevo!</p>
    <h5 class="menu-text mb-1">{{ Auth::user()->name }}</h5>
    <div class="small text-truncate">
        
    </div>
</div>
<div class="app-brand demo py-3 me-6">
   
    {{-- <a class="px-0 me-lg-6 layout-menu-toggle menu-link text-large ms-auto" href="javascript:void(0)">
        <i class="ri-menu-line ri-24px align-middle"></i>
    </a> --}}
</div>
<div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1 ps ps--active-y" id="menu1">
@if(auth()->user()->hasRole('admin'))
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
            <i class="menu-icon ri-dashboard-line"></i>
            <div>Users</div>
        </a>
    </li>
    @endif
    @if(auth()->user()->hasRole('admin'))
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
            <i class="menu-icon ri-dashboard-line"></i>
            <div>Dashboard</div>
        </a>
    </li>
    @endif
    <li class="menu-item {{ request()->routeIs('proyectos.index') ? 'active' : '' }}">
        <a href="{{ route('proyectos.index') }}" class="menu-link">
            <i class="menu-icon ri-home-smile-line"></i>
            <div>Proyectos</div>
        </a>
    </li>
    <li class="menu-item {{ request()->routeIs('almacen.index') ? 'active' : '' }}">
        <a href="{{ route('almacen.index') }}" class="menu-link">
            <i class="menu-icon ri-store-line"></i>
            <div>Almacén</div>
        </a>
    </li>
    <li class="menu-item {{ request()->routeIs('requisiciones.index') ? 'active' : '' }}">
        <a href="{{ route('requisiciones.index') }}" class="menu-link">
            <i class="menu-icon ri-archive-stack-line"></i>
            <div>Requisiciones</div>
        </a>
    </li>
    <li class="menu-item {{ request()->routeIs('cotizaciones.index') ? 'active' : '' }}">
        <a href="{{ route('cotizaciones.index') }}" class="menu-link">
            <i class="menu-icon ri-mail-send-fill"></i>
            <div>Cotizaciones</div>
        </a>
    </li>
    <li class="menu-item {{ request()->routeIs('pagos.index') ? 'active' : '' }}">
        <a href="{{ route('pagos.index') }}" class="menu-link">
            <i class="menu-icon ri-money-dollar-circle-line"></i>
            <div>Pagos</div>
        </a>
    </li>
</ul>
