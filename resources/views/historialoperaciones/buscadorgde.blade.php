@extends('layouts.app')



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>






<style>
    <style>.small-box {
        text-align: center;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 10px;
        color: #fff;
    }

    .small-box h3 {
        font-size: 28px;
        margin-top: 0;
    }

    .small-box p {
        font-size: 14px;
    }

    /* Colores */
    .bg-planta {
        background-color: #ff6b6b;
        /* Rojo anaranjado */
    }

    .bg-jubilaciones {
        background-color: #72d572;
        /* Verde claro */
    }

    .bg-ausentismo {
        background-color: #f9cb42;
        /* Amarillo */
    }

    .bg-altas {
        background-color: #5499c7;
        /* Azul claro */
    }

    html,
    body,
    #containerb {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #div_generoxv {
        width: 50%;
        height: 50%;
        margin: 0;
        padding: 0;
    }

    #div_uor {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 700px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    /* Estilos para la barra horizontal */
    .barra-horizontal {
        background-color: #4058A9;
        /* Fondo azul */
        color: white;
        /* Letras blancas */
    }

    .tarjeta-container {
        margin-top: 20px;
        /* Puedes ajustar el valor según sea necesario */
    }

    ul {
    border: none;
    /* O puedes usar border: 0; para eliminar el borde */
    }    
</style>




@section('content')

<!-- Main content -->




<section class="content container-fluid">

    <!-- @include('flash::message') -->

    <!-- Línea separadora -->
    <div class="col-12  tarjeta-container">
        <hr style="border-color: #ccc;"> <!-- Estilo y color de la línea a tu elección -->
    </div>









    <div class="row tarjeta-container">




    </div>


    <div class="col-xl-9 col-md-9 mb-4">

        <h1>Expedientes Electrónicos</h1>

        <!-- Formulario para capturar el término de búsqueda -->

        <form method="POST" action="{{ route('buscador_gde') }}" style="margin-left: 20px;">

            @csrf
            <label for="query">Buscar:</label>
            <input type="text" id="query" name="query">
            <br>

            <!-- <label for="cantidad_registros">Cantidad de Registros:</label>
            <input type="number" id="cantidad_registros" name="cantidad_registros" value="10"> -->
            <br>

            <!-- Otros campos para filtros, si los tienes -->

            <button type="submit">Enviar</button>
        </form>

        <!-- Mostrar los resultados -->
        @if(isset($resultados))
        <h2>Resultados</h2>
        <!-- <ul style="list-style-type: space-counter;"  >  -->
        <ul style="list-style-type: space-counter;"  class="list-group list-group-flush">
            @foreach($resultados as $resultado)
            <li class="list-group-item">
                <ul>
                    @foreach($resultado as $key => $value)
 
                 
                        <p><strong>{{ $key }}:</strong>
                        @if(is_array($value))
                        <!-- Si es un array, mostrar sus elementos -->
                                    <!-- Si es un array, mostrar sus elementos -->
                                    
                                        @foreach($value as $item)
                                            <td>[{{ $item }}]</td>
                                        @endforeach 
                                    
                
                        @else
                        <!-- Si es un valor simple, mostrarlo -->
                        
                        <td>{{ $value }}</td>          
                        <p>              
                        @endif
                    
             
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
        @endif

    </div>



</section>


@endsection