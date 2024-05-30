@extends('layouts.app')
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre y Apellido</th>
                <th>ID M4</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Código de Jubilación</th>
                <th>Organización Especial</th>
                <th>Observación</th>
                <th>ID Usuario</th>
                <th>Fecha Actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item['DNI'] }}</td>
                <td>{{ $item['NOMBREAPELLIDO'] }}</td>
                <td>{{ $item['ID_M4'] }}</td>
                <td>{{ $item['DT_START'] }}</td>
                <td>{{ $item['DT_END'] }}</td>
                <td>{{ $item['COD_JUBILACION'] }}</td>
                <td>{{ $item['STD_N_EXT_ORGESP'] }}</td>
                <td>{{ $item['OBSERVACION'] }}</td>
                <td>{{ $item['ID_SECUSER'] }}</td>
                <td>{{ $item['FECHA_ACTUALIZA'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection