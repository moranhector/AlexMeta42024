<div class="table-responsive">
    <table class="table" id="usuarios-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Apellido Nombre</th>
        <th>Nombre Usuario</th>
        <th>Mail</th>
        <th>Numero Cuit</th>
        <th>Codigo Reparticion</th>
        <th>Nombre Reparticion</th>
        <th>Codigo Sector Interno</th>
        <th>Cargo</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->apellido_nombre }}</td>
            <td>{{ $usuario->nombre_usuario }}</td>
            <td>{{ $usuario->mail }}</td>
            <td>{{ $usuario->numero_cuit }}</td>
            <td>{{ $usuario->codigo_reparticion }}</td>
            <td>{{ $usuario->nombre_reparticion }}</td>
            <td>{{ $usuario->codigo_sector_interno }}</td>
            <td>{{ $usuario->cargo }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['usuarios.destroy', $usuario->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('usuarios.show', [$usuario->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('usuarios.edit', [$usuario->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
