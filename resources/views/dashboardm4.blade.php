<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<div class="container">
    <h1>Dashboard</h1>

    <div class="card">
        <div class="card-header">
            Datos de Género
        </div>
        <div class="card-body">
            @foreach ($genero as $data)
                <p>{{ $data->GENERO }}: {{ $data->CANTIDAD }}</p>
            @endforeach
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Datos de Planta
        </div>
        <div class="card-body">
            <p>Total de personas en planta: {{ $planta[0]->PERSONAS }}</p>
        </div>
    </div>
</div>

</body>
</html>
