@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Usuarios M4 y Oficinas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('personas.create') }}"> Alta usuario</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <br>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('personas.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por M4User, Nombre o Etiqueta" value="{{ request()->query('search') }}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
                </div>

                <div>
                    <!-- Botón para exportar los datos a Excel -->
                    <button type="submit" name="export_excel" value="1" class="btn btn-success">Exportar a Excel</button>
                </div>


            </form>
        </div>
    </div>

    <br>


    <table class="table table-bordered">
        <tr>
            <!-- <th>No</th> -->
            <th>Usuario M4</th>
            <th>Nombre</th>
            <th>Institución</th>
            <th>Email</th>
            <!-- <th>Celular</th> -->
            <th>Observaciones</th>
            <th width="170px">Acciones</th>
        </tr>


        @foreach ($personas as $persona)
        <tr>

            <td>{{ $persona->m4user }}</td>
            <td>{{ $persona->nombre }}</td>
            <td>{{ $persona->etiqueta }}</td>
            <td>{{ $persona->email }}</td>
            <!-- <td>{{ $persona->celular }}</td> -->
            <td>{{ $persona->observaciones }}</td>

            <td>
                <div class="btn-group" role="group">
                    <a class="btn btn-info" href="{{ route('personas.show', $persona->id) }}">Ver</a>
                    <a class="btn btn-primary" href="{{ route('personas.edit', $persona->id) }}">Editar</a>

                    <!-- Formulario para eliminar -->
                    <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</button>
                    </form>
                </div>
            </td>

        </tr>
        @endforeach
    </table>
</div>
@endsection