@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear Nueva Persona</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('personas.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Atención!</strong> Hubo algunos problemas con tu entrada.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('personas.store') }}" method="POST">
        @csrf

        <div class="row">


            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>M4User:</strong>
                    <input type="text" name="m4user" class="form-control" placeholder="M4User">
                </div>
            </div> -->

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>M4User:</strong>
                    <input list="m4users" name="m4user" class="form-control" placeholder="M4User" value="{{ old('m4user') }}">
                    <datalist id="m4users">
                        @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario }}">
                            {{ $usuario }}
                        </option>
                        @endforeach
                    </datalist>
                </div>
            </div>





            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                </div>
            </div>
            <!-- ACA INSERTAR ETIQUETAS JURISDICCION -->
            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Etiqueta:</strong>
                    <input type="text" name="etiqueta" class="form-control" placeholder="Etiqueta">
                </div>
            </div> -->

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jurisdicción:</strong>
                    <select name="etiqueta" class="form-control">
                        <option value="">Seleccione una opción</option> <!-- Opción por defecto -->
                        @foreach ($etiquetas as $etiqueta)
                        <option value="{{ $etiqueta->etiqueta }}" {{ old('etiqueta') == $etiqueta->etiqueta ? 'selected' : '' }}>
                            {{ $etiqueta->etiqueta }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- FIN INSERTAR ETIQUETAS JURISDICCION -->

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Oficina:</strong>
                    <input type="text" name="oficina" class="form-control" placeholder="Escriba la descripción de la oficina">
                </div>
            </div>

            <!-- FIN INSERTAR ETIQUETAS JURISDICCION -->

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Principal:</strong>
                    <input type="checkbox" name="es_principal" value="0">
                    <!-- <label for="es_principal">Es responable principal de la oficina</label>                     -->
                </div>
            </div>

            



            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Celular:</strong>
                    <input type="text" name="celular" class="form-control" placeholder="Celular">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Observaciones:</strong>
                    <textarea class="form-control" style="height:150px" name="observaciones" placeholder="Observaciones"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>
@endsection