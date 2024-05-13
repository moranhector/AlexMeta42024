


<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
        <i class="fa fa-chart-pie"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('planta') }}" class="nav-link {{ Request::is('planta') ? 'active' : '' }}">

        <i class="fa fa-users" style="color:white"></i>
        <p>Planta de Personal</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('jubilaciones') }}" class="nav-link {{ Request::is('jubilaciones') ? 'active' : '' }}">

        <i class="fas fa-user-tie" style="color:white"></i>
        <p>Jubilaciones</p>
    </a>
</li>



<!-- <li class="nav-item">
    <a href="#" onclick="event.preventDefault(); document.getElementById('buscadorForm').submit();" class="nav-link { { Request::is('buscador_gde') ? 'active' : '' } }">
        <i class="fas fa-user"></i>
        <p>Buscar GDE</p>
    </a>
    <form id="buscadorForm" action="{ { route('buscador_gde') } }" method="POST" style="display: none; margin-left: 200px;">
        @csrf
    </form>
</li> -->

<li class="nav-item">
    <a href="{{ route('personas') }}" class="nav-link {{ Request::is('personas') ? 'active' : '' }}">

    <i class="fas fa-user"></i>
        <p>Personas</p>
    </a>
</li>


