@extends('layouts.app')

<style>
    /* En tu archivo de estilos CSS */
    th {
        color: #ffffff;
        /* Cambia el color del texto de todos los <th> a blanco */
    }

    /* En tu archivo de estilos CSS */
    thead {
        background-color: #007bff;
        /* Cambia el color de fondo de todos los <thead> */
    }


    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        background-color: #f9f9f9;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card p {
        margin: 0;
        font-size: 1em;
    }

    .card .number {
        font-size: 2em;
        font-weight: bold;
        color: #333;
    }
</style>

@section('content')



<div class="container">
    @if (session()->has('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
    @endif

    <h1>Futuros Jubilados</h1>


    <!-- Botón para actualizar los futuros jubilados desde la API -->
    <a href="{{ url('/futurosjubilados/create_from_json') }}" class="btn btn-success mb-3">
        Actualizar Futuros Jubilados
    </a>


    <form method="GET" action="{{ route('futurojubilado.index') }}">


        <div class="row">
            <div class="col-md-4 form-group">
                <label for="etiqueta">Selecciona una Jurisdicción:</label>
                <select id="etiqueta" name="etiqueta" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    @foreach ($etiquetas as $etiqueta)
                    <option value="{{ $etiqueta->etiqueta }}" {{ request('etiqueta') == $etiqueta->etiqueta ? 'selected' : '' }}>
                        {{ $etiqueta->etiqueta }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="estado">Selecciona un estado de trámite:</label>
                <select id="estado" name="estado" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos los estados</option>
                    <option value="STI">Sin trámites iniciados</option>
                    @foreach ($estados as $estado)
                    <option value="{{ $estado->last_cod_jub }}" {{ request('estado') == $estado->last_cod_jub ? 'selected' : '' }}>
                        {{ $estado->last_cod_jub }} {{ $estado->last_cod_jub_desc }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="search">Buscar persona:</label>
                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Buscar por nombre o CUIL">
            </div>





        </div>


        <!-- SEGUNDA FILA -->

        <div class="row">
            <div class="col-md-4 form-group">
                <label for="regimen">Selecciona un régimen:</label>
                <select id="regimen" name="regimen" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos los regímenes</option>
                    @foreach ($regimenes as $regimen)


                    <option value="{{ $regimen->regimen }}" {{ request('regimen') == $regimen->regimen ? 'selected' : '' }}>
                        {{ $regimen->regimen }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="genero">Selecciona un género:</label>
                <select id="genero" name="genero" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    @foreach ($generos as $genero)
                    <option value="{{ $genero->genero }}" {{ request('genero') == $genero->genero ? 'selected' : '' }}>
                        {{ $genero->genero }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="comment">Filtro por observaciones:</label>
                <select id="comment" name="comment" class="form-control" onchange="this.form.submit()">
                    <option value="" {{ request('comment') === '' ? 'selected' : '' }}>Todos</option>
                    <option value="con" {{ request('comment') === 'con' ? 'selected' : '' }}>Con observaciones</option>
                    <option value="sin" {{ request('comment') === 'sin' ? 'selected' : '' }}>Sin observaciones</option>
                </select>
            </div>

        </div>


        <div class="row">
            <div class="col-md-7">
                <!-- Botón para buscar -->
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
            <div class="col-md-3 text-right">


                <label>
                    <input type="checkbox" id="mostrarjubilados" name="mostrarjubilados" onchange="this.form.submit()" {{ $mostrarjubilados ? 'checked' : '' }}>
                    Mostrar Jubilados
                </label>


            </div>

            <div class="col-md-2 text-right">
                <!-- Botón para exportar los datos a Excel -->
                <button type="submit" name="export_excel" value="1" class="btn btn-success">Exportar a Excel</button>
            </div>
        </div>





    </form>






    <div class="card">
        <p>Total de futuros jubilados: <span class="number">{{ $totalJubilados }}</span></p>
    </div>

    <!-- Tabla    project://resources\views\futurojubilado\table_principal.blade.php  -->
    @include('futurojubilado.table_principal')
    <!-- Tabla    project://resources\views\futurojubilado\table_principal.blade.php  -->



    <div class="card mt-20">
        <p>Total de futuros jubilados: <span class="number">{{ $totalJubilados }}</span></p>
    </div>

    <div class="mt-20">
        <p>Alex Futuros Jubilados - DIC 2024</p>
    </div>


    <!-- Modal   project://resources\views\futurojubilado\modal.blade.php  -->
    @include('futurojubilado.table_principal')
    <!-- Modal   -->



</div>





 


@endsection