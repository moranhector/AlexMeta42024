<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $usuario->nombre }}</p>
</div>

<!-- Apellido Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('apellido_nombre', 'Apellido Nombre:') !!}
    <p>{{ $usuario->apellido_nombre }}</p>
</div>

<!-- Nombre Usuario Field -->
<div class="col-sm-12">
    {!! Form::label('nombre_usuario', 'Nombre Usuario:') !!}
    <p>{{ $usuario->nombre_usuario }}</p>
</div>

<!-- Mail Field -->
<div class="col-sm-12">
    {!! Form::label('mail', 'Mail:') !!}
    <p>{{ $usuario->mail }}</p>
</div>

<!-- Numero Cuit Field -->
<div class="col-sm-12">
    {!! Form::label('numero_cuit', 'Numero Cuit:') !!}
    <p>{{ $usuario->numero_cuit }}</p>
</div>

<!-- Codigo Reparticion Field -->
<div class="col-sm-12">
    {!! Form::label('codigo_reparticion', 'Codigo Reparticion:') !!}
    <p>{{ $usuario->codigo_reparticion }}</p>
</div>

<!-- Nombre Reparticion Field -->
<div class="col-sm-12">
    {!! Form::label('nombre_reparticion', 'Nombre Reparticion:') !!}
    <p>{{ $usuario->nombre_reparticion }}</p>
</div>

<!-- Codigo Sector Interno Field -->
<div class="col-sm-12">
    {!! Form::label('codigo_sector_interno', 'Codigo Sector Interno:') !!}
    <p>{{ $usuario->codigo_sector_interno }}</p>
</div>

<!-- Cargo Field -->
<div class="col-sm-12">
    {!! Form::label('cargo', 'Cargo:') !!}
    <p>{{ $usuario->cargo }}</p>
</div>

