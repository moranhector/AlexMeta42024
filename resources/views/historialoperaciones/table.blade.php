<div class="table-responsive">
    <table class="table" id="historialoperaciones-table">
        <thead>
        <tr>
            <th>Tipo de operación</th>
        <th>Usuario</th>
        <th>Expediente</th>
        <th>Id Expediente</th>
        <th>Código Repartición Destino</th>
        <th>Repartición Usuario</th>
        <th>Destinatario</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($historialoperaciones as $historialoperaciones)
            <tr>
            <td>{{ $historialoperaciones->TIPO_OPERACION }}</td>
            <td>{{ $historialoperaciones->USUARIO }}</td>
            <td>{{ $historialoperaciones->EXPEDIENTE }}</td>
            <td>{{ $historialoperaciones->ID_EXPEDIENTE }}</td>
            <td>{{ $historialoperaciones->CODIGO_REPARTICION_DESTINO }}</td>
            <td>{{ $historialoperaciones->REPARTICION_USUARIO }}</td>
            <td>{{ $historialoperaciones->DESTINATARIO }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
