@extends('layouts.app')

@section('content')

<div class="container" style="margin-left: 80px;">

    <h1>Seguimiento de Usuario: {{ $usuario }}</h1>

    <form id="seguimiento-form" action="{{ route('personas.guardarSeguimiento') }}" method="POST">
        @csrf
        <input type="hidden" name="m4user" value="{{ $usuario }}">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Observaciones:</strong>
                <textarea class="form-control" style="height:400px" name="observaciones" placeholder="Observaciones" id="observaciones" cols="30" rows="10">{{ $observaciones }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar Seguimiento</button>

        </div>
    </form>

    <!-- Botones de navegación -->
    <div class="form-group mt-3">
        <button type="button" class="btn btn-secondary" onclick="history.back()">Volver</button>

    </div>

</div>

@endsection

