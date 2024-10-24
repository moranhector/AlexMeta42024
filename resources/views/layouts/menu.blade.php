<style>
        .nav-icon, .nav-icon .fas, .nav-icon .fa {
            color: #ffffff;
            opacity: 1;
        }


    </style>
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
        <i class="fa fa-chart-pie nav-icon"></i>
        <p>Dashboard</p>
    </a>
</li>

<!-- <li class="nav-item">
    <a href="{{ route('planta') }}" class="nav-link {{ Request::is('planta') ? 'active' : '' }}">
        <i class="fa fa-users nav-icon"></i>
        <p>Planta de Personal</p>
    </a>
</li> -->

<li class="nav-item">
    <a href="{{ route('jubilaciones') }}" class="nav-link {{ Request::is('jubilaciones') ? 'active' : '' }}">
        <i class="fas fa-user-tie nav-icon"></i>
        <p>Jubilaciones</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('busca_personas') }}" class="nav-link {{ Request::is('busca_personas') ? 'active' : '' }}">
        <i class="fas fa-user nav-icon"></i>
        <p>Buscar Personas</p>
    </a>
</li>







@php
    $allowedUsers = ['victoria@mail', 'cano@mail','gonzalojerez@gobierno','creta@gobierno','rbordonaro@gobierno'];
@endphp

<li class="nav-item">
    @if(in_array(Auth::user()->email, $allowedUsers))
        <a href="{{ route('futurosjubilados.index') }}" class="nav-link {{ Request::is('futurosjubilados') ? 'active' : '' }}">
            <i class="fas fa-users nav-icon"></i>
            <p>Futuros Jubilados</p>
        </a>
    @endif
</li>


<li class="nav-item">
    <a href="{{ route('personas.index') }}" class="nav-link {{ Request::is('personas') ? 'active' : '' }}">
        <i class="fa fa-users-cog nav-icon"></i>
        <p>Usuarios M4</p>
    </a>
</li>

 

<li class="nav-item">
    @if(in_array(Auth::user()->email, $allowedUsers))
        <a href="{{ route('bajas.index') }}" class="nav-link {{ Request::is('bajas') ? 'active' : '' }}">
            <i class="fas fa-user-slash  nav-icon"></i>
            <p>Informe Bajas</p>
        </a>
    @endif
</li>

 
