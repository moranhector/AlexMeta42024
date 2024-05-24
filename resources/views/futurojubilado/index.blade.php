@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Futuros Jubilados</h1>





    <form method="GET" action="{{ route('futurojubilado.index') }}">
        <div class="form-group">
            <label for="etiqueta">Selecciona una etiqueta:</label>
            <select id="etiqueta" name="etiqueta" class="form-control" onchange="this.form.submit()">
                <option value="">Todas las etiquetas</option>
                @foreach ($etiquetas as $etiqueta)
                    <option value="{{ $etiqueta->etiqueta }}" {{ request('etiqueta') == $etiqueta->etiqueta ? 'selected' : '' }}>
                        {{ $etiqueta->etiqueta }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="estado">Selecciona un estado:</label>
            <select id="estado" name="estado" class="form-control" onchange="this.form.submit()">
                <option value="">Todos los estados</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado->last_cod_jub }}" {{ request('estado') == $estado->last_cod_jub ? 'selected' : '' }}>
                        {{ $estado->last_cod_jub }} - {{ $estado->last_cod_jub_desc }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="search">Buscar persona:</label>
            <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Buscar por nombre o CUIL">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>        

    </form>



    <p>Total de futuros jubilados: {{ $totalJubilados }}</p>
    <table class="table">
        <thead>
            <tr>
                <th>CUIL</th>
                <th>Nombre y Apellido</th>
                <!-- <th>Fecha de Nacimiento</th> -->
                <th>Edad</th>
                <!-- <th>Fecha de Ingreso</th> -->
                <!-- <th>Género</th> -->
                <!-- <th>Periodo</th> -->
                <th>Descripción UOR</th>
                <th>Dependencia</th>
                <th>Etiqueta</th>
                <th>Cod.</th>
                <!-- <th>Clase</th> -->
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($futurosjubilados as $futuro)
            <tr>
                <td>{{ $futuro->cuil }}</td>
                <td>{{ $futuro->nombreapellido }}</td>
                <!-- <td>{{ $futuro->fechanacimiento }}</td> -->
                <td>{{ $futuro->edad }}</td>
                <!-- <td>{{ $futuro->fechaingreso }}</td> -->
                <!-- <td>{{ $futuro->genero }}</td> -->
                <!-- <td>{{ $futuro->periodo }}</td> -->
                <td>{{ $futuro->descripcionuor }}</td>
                <td>{{ $futuro->dependencia }}</td>
                <td>{{ $futuro->etiqueta }}</td>
                <td>{{ $futuro->last_cod_jub }}</td>
                <!-- <td>{{ $futuro->clase }}</td> -->
                <td>
                    <a href="{{ route('futurojubilado.show', $futuro->cuil) }}" class="btn btn-info">Ver</a>
                </td>
                <td>
                    <a href="{{ route('futurojubilado.edit', $futuro->cuil) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="{{ route('futurojubilado.destroy', $futuro->cuil) }}" class="btn btn-danger">Del</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection