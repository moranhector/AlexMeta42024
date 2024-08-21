@extends('layouts.app')

@section('content')


<div class="container" style="margin-left: 80px;">

    <h1>Seguimiento de Usuario: {{ $usuario }}</h1>

    <form action="{{ route('personas.guardarSeguimiento') }}" method="POST">
        @csrf
        <input type="hidden" name="m4user" value="{{ $usuario }}">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Observaciones:</strong>
                <textarea class="form-control" style="height:150px" name="observaciones" placeholder="Observaciones">{{ $observaciones }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Seguimiento</button>
    </form>


</div>





@endsection