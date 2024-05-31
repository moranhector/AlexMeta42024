@extends('layouts.app')
<style>
    .form-row {
        display: flex;
        justify-content: space-between;
    }
    .form-group {
        flex: 1;
        display: flex;
        align-items: center;
        margin-right: 15px;
    }
    .form-group:last-child {
        margin-right: 0;
    }
    .form-group label {
        margin-right: 10px;
        white-space: nowrap; /* Esto asegura que el label no se rompa en varias líneas */
    }
    .form-group input {
        flex: 1;
    }
</style>
@section('content')
<div class="float-right">
    <div class="btn-group btn-group-sm" role="group">
        <a href="javascript:history.back()" title="Regresar 1">
            <button type="button" class="btn btn-info btn-flat">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
    </div>
</div>

<div class="container mt-5">
    <h2 class="mb-4">Datos de Futuros Jubilados</h2>


    <div class="form-group">
        <label for="nombreapellido">Nombre y Apellido</label>
        <input type="text" class="form-control" id="nombreapellido" name="nombreapellido" value="{{ $futuro->nombreapellido }}" readonly>
    </div>



    <div class="form-row">
        <div class="form-group">
            <label for="cuil">Cuil</label>
            <input type="text" class="form-control" id="cuil" name="cuil" value="{{ $futuro->cuil }}" readonly>
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" value="{{ $dni }}" readonly>
        </div>
        <div class="form-group">
            <label for="idM4">Id M4</label>
            <input type="text" class="form-control" id="idM4" name="idM4" value="{{ isset($data[0]['ID_M4']) ? $data[0]['ID_M4'] : '' }}" readonly>

        </div>
    </div>


    <div class="form-group">
        <label for="comments">Comentarios</label>
        <textarea class="form-control" id="comments" name="comments" rows="1" readonly>
        {{ $futuro->comments }}
        </textarea>
    </div>

    <!-- "id" => 1
    "cuil" => "27165537098"
    "nombreapellido" => "PIZARRO, MARIA ALEJANDRA"
    "fechanacimiento" => "1963-09-05"
    "edad" => 60
    "fechaingreso" => "1995-01-01"
    "genero" => "F"
    "periodo" => "202404"
    "descripcionuor" => "Dir de Fiscaliz, Control y Tecn. Agroind."
    "dependencia" => "Direccion de Fiscalizac"
    "etiqueta" => "MIN ECONOMIA Y ENER"
    "rats" => "510302"
    "clase" => 8
    "comments" => "ya vimos el caso"
    "last_cod_jub" => "J01"
    "last_cod_jub_desc" => "Sistema de Reparto"
    "last_fecha_desde" => "1995-01-01"
    "last_fecha_hasta" => "4000-01-01"
    "last_observacion" => null
    "id_secuser" => "BSIMONOVICH"
    "fecha_actualiza" => "2023-05-23"
    "created_at" => "2024-05-29 15:53:09"
    "updated_at" => "2024-05-30 12:05:11"     -->


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Código de Trámite</th>
                <th>Observación</th>
                <th>Usuario</th>
                <th>Fecha Actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>


                <td>{{ Carbon\Carbon::parse( $item['DT_START'] )->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse( $item['DT_END'] )->format('d/m/Y') }}</td>
                <td>{{ $item['COD_JUBILACION'] ." ". $item['STD_N_EXT_ORGESP'] }}</td>
                <td>{{ $item['OBSERVACION'] }}</td>
                <td>{{ $item['ID_SECUSER'] }}</td>
                <td>{{ $item['FECHA_ACTUALIZA'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection