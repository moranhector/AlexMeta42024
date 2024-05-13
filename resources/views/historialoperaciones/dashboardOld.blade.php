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
</style>




@section('content')

<!-- Main content -->




<section class="content container-fluid">

    <!-- @include('flash::message') -->

    <!-- Línea separadora -->
    <div class="col-12  tarjeta-container">
        <hr style="border-color: #ccc;"> <!-- Estilo y color de la línea a tu elección -->
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" id="jubilados-total">
            <div class="card-body ">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Empleados en condiciones de jubilarse</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>



                    </div>
                    <div class="col-auto">

                        <i class="fas fa-male fa-2x text-gray-300"></i>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row tarjeta-container">

        <div class="col-lg-3 col-6"  id="planta-card" >

            <div class="small-box bg-planta">

                <div class="inner">
                    <h3>{{ $plantaTotal->first()->personas }}</h3>
                    <h5> </h5>
                    <p>Planta Total y</p>
                </div>


                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('planta') }}" class="small-box-footer">
                    Más info
                    <i class="fas fa-arrow-circle-right" data-toggle="modal" data-target="#expedientesEntregadosAyer"></i>
                </a>


            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-jubilaciones">

                <div class="inner" id="jubilados-card">
                    <h3 class="h5"> </h3>
                    <p>En edad Jubilatoria </p>
                </div>



                <a href="{{ route('jubilaciones') }}" class="small-box-footer">
                    Más info
                    <i class="fas fa-arrow-circle-right" data-toggle="modal" data-target="#expedientesEntregadosAyer"></i>
                </a>


            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-ausentismo">
                <div class="inner">
                    <h3>{{ 45 }} días<sup style="font-size: 20px"></sup></h3>
                    <p>Ausentismo</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('ausentismo') }}" class="small-box-footer">
                    Más info
                    <i class="fas fa-arrow-circle-right" data-toggle="modal" data-target="#expedientesEntregadosAyer"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-altas">
                <div class="inner">
                    <h3>{{ 124  }}<sup style="font-size: 20px"></sup></h3>
                    <p>Licencias en el año</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('licencias') }}" class="small-box-footer">
                    Más info
                    <i class="fas fa-arrow-circle-right" data-toggle="modal" data-target="#expedientesEntregadosAyer"></i>
                </a>
            </div>
        </div>

    </div>


    <div class="col-xl-3 col-md-6 mb-8">

        <div class="card border-left-primary shadow h-40 py-2">
            <div class="card-body">

                <!-- INFO PERIODO -->
                <div class="periodo-info">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Datos actualizados en mes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mesEspanol }} {{ $numeroAnio }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>

                <!-- INFO DIA -->
                <div class="info-dia">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Fecha de Hoy</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3/10/2023</div>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>












</section>



<script>
    async function actualizarDatosJubilados() {
        try {
            const response = await fetch('http://localhost:3000/jubilaciones/202309');
            const data = await response.json();
            const cantidadJubilados = data.totales;
            console.log(cantidadJubilados);

            // Actualiza el contenido de la tarjeta con la nueva cantidad de jubilados
            const jubiladosCard = document.getElementById('jubilados-card');
            jubiladosCard.querySelector('.h5').textContent = cantidadJubilados;


        } catch (error) {
            console.error('Error al obtener los datos de jubilados:', error);
        }
    }

    // Llama a la función para actualizar los datos al cargar la página
    actualizarDatosJubilados();
</script>












<!-- GENERO
 ██████╗ ███████╗███╗   ██╗███████╗██████╗  ██████╗ 
██╔════╝ ██╔════╝████╗  ██║██╔════╝██╔══██╗██╔═══██╗
██║  ███╗█████╗  ██╔██╗ ██║█████╗  ██████╔╝██║   ██║
██║   ██║██╔══╝  ██║╚██╗██║██╔══╝  ██╔══██╗██║   ██║
╚██████╔╝███████╗██║ ╚████║███████╗██║  ██║╚██████╔╝
 ╚═════╝ ╚══════╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝ ╚═════╝ 
                                                     -->




<script>
    var url3 = "{{ url('genero') }}";
    var Etiquetas3 = new Array();
    var Cantidades3 = new Array();



    $(document).ready(function() {
        $.get(url3, function(response) {
            response.forEach(function(data) {
                Etiquetas3.push(data.genero);
                Cantidades3.push(data.cantidad);
                console.log(Cantidades3);
            });
            var ctx3 = document.getElementById("canvas_genero").getContext('2d');
            var myChart = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: Etiquetas3,
                    datasets: [{
                        label: Etiquetas3,

                        data: Cantidades3,
                        borderWidth: 1,
                        backgroundColor: [
                            '#FF1493', // Rosa
                            '#00BFFF', // Celeste
                            '#808080' // Gris
                        ],
                        borderColor: [
                            'rgba(205, 71, 43, 1)', // Borde rosa
                            'rgba(255, 206, 86, 1)', // Borde celeste
                            'rgba(75, 192, 192, 1)' // Borde gris
                        ]
                    }]

                },

                options: {
                    title: {
                        display: true,
                        text: 'Genero'
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 20
                        }
                    }
                }
            });
        });
    });
</script>

<!-- UOR
██╗   ██╗███╗   ██╗██╗██████╗  █████╗ ██████╗      ██████╗ ██████╗  ██████╗ 
██║   ██║████╗  ██║██║██╔══██╗██╔══██╗██╔══██╗    ██╔═══██╗██╔══██╗██╔════╝ 
██║   ██║██╔██╗ ██║██║██║  ██║███████║██║  ██║    ██║   ██║██████╔╝██║  ███╗
██║   ██║██║╚██╗██║██║██║  ██║██╔══██║██║  ██║    ██║   ██║██╔══██╗██║   ██║
╚██████╔╝██║ ╚████║██║██████╔╝██║  ██║██████╔╝    ╚██████╔╝██║  ██║╚██████╔╝
 ╚═════╝ ╚═╝  ╚═══╝╚═╝╚═════╝ ╚═╝  ╚═╝╚═════╝      ╚═════╝ ╚═╝  ╚═╝ ╚═════╝ 
                                                                             -->








<!-- FIN UOR -->
<!-- FIN UOR -->
<!-- FIN UOR -->






<!-- GENERO
 ██████╗ ███████╗███╗   ██╗███████╗██████╗  ██████╗ 
██╔════╝ ██╔════╝████╗  ██║██╔════╝██╔══██╗██╔═══██╗
██║  ███╗█████╗  ██╔██╗ ██║█████╗  ██████╔╝██║   ██║
██║   ██║██╔══╝  ██║╚██╗██║██╔══╝  ██╔══██╗██║   ██║      22222
╚██████╔╝███████╗██║ ╚████║███████╗██║  ██║╚██████╔╝
 ╚═════╝ ╚══════╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝ ╚═════╝ 
                                                     -->





<script>
    function showAnotherChart(selectedUOR) {
        // Realiza una llamada a la API con el UOR seleccionado
        //console.log('showAnotherChart ', 'http://localhost:8000/uor-explode/' + selectedUOR);
        fetch('http://localhost:8000/uor-explode/' + selectedUOR) // Reemplaza 'uor' con la URL correcta de tu API Laravel
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el nuevo gráfico
                var newData = jsonData.map((item, index) => ({
                    name: item.uor,
                    value: item.cantidad,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));


                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#00FF00', '#FFD700'];
                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el nuevo gráfico TreeMap
                Highcharts.chart('container', {
                    colorAxis: {
                        minColor: '#FFFFFF',
                        maxColor: Highcharts.getOptions().colors[0]
                    },
                    series: [{
                        type: 'treemap',
                        layoutAlgorithm: 'squarified',
                        clip: false,
                        data: newData,
                        title: {
                            text: 'Planta Total distribuída por UOR: ' + selectedUOR
                        }
                    }],
                    title: {
                        text: 'Planta distribuída por UOR:' + selectedUOR
                    }
                });






            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Obtener los datos desde la API REST en Laravel
        fetch('http://localhost:8000/uor')
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el gráfico
                var data = jsonData.map((item, index) => ({
                    name: item.uor,
                    value: item.cantidad,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));

                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#00FF00', '#FFD700'];
                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el gráfico TreeMap
                Highcharts.chart('container', {
                    colorAxis: {
                        minColor: '#FFFFFF',
                        maxColor: Highcharts.getOptions().colors[0]
                    },
                    series: [{
                        type: 'treemap',
                        layoutAlgorithm: 'squarified',
                        clip: false,
                        data: data,
                        events: {
                            click: function(event) {
                                // Obtener el UOR seleccionado
                                var selectedUOR = event.point.name;

                                //alert('Clic en el sector: ' +  selectedUOR );                            

                                // Llamar a la función para mostrar el nuevo gráfico
                                showAnotherChart(selectedUOR);
                            }
                        }
                    }],
                    title: {
                        text: 'Planta Total distribuída por UOR:'
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    });
</script>


<script>
    anychart.onDocumentReady(function() {
        // create pie chart
        var chart = anychart.pie();

        // set chart title
        chart.title('Distribución por Género');

        // Obtener los datos desde la API REST en Laravel
        fetch('http://localhost:8000/generoxv') // Reemplaza 'generoxv' con la URL correcta de tu API Laravel
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el chart
                var chartData = jsonData.map(item => ({
                    x: item.x,
                    value: item.value
                }));

                // set chart data
                chart.data(chartData);

                // Asignar colores personalizados a los sectores
                chart.palette(['#FF1493', '#00BFFF', '#808080']); // Rosa, Azul, Gris

                // Agregar un evento de clic a los sectores
                chart.listen('pointClick', function(e) {
                    var point = e.point;
                    alert('Clic en el sector: ' + point.x + ', Valor: ' + point.value);
                });


                // set container id for the chart
                chart.container('div_generoxv');

                // initiate chart drawing
                chart.draw();
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    });
</script>


<script>
    async function actualizarDatosPlanta() {
        console.log('entra a actualizarPlanta');
        try {
            // Mostrar el loader al iniciar la carga de datos
            document.getElementById('loader').style.display = 'block';


            //const response = await fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_v3');
            const response = await fetch('http://localhost:3000/planta');
            const data = await response.json();

            const cantidadPlanta = data.totales;
            const plantaCard = document.getElementById('planta-card');
            plantaCard.querySelector('.h5').textContent = cantidadPlanta;


            // Oculta el loader al finalizar la carga de datos
            document.getElementById('loader').style.display = 'none';
        } catch (error) {
            console.error('Error al obtener los datos de jubilados:', error);
        }
    }
    // Llama a la función para actualizar los datos al cargar la página
    actualizarDatosPlanta();
</script>


<script>
    async function actualizarDatosJubilados() {
        try {
            // Mostrar el loader al iniciar la carga de datos
            document.getElementById('loader').style.display = 'block';

            //const response = await fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_v3');
            const response = await fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_v3');
            const data = await response.json();

            const cantidadJubilados = data.hombres;
            const jubiladosCard = document.getElementById('jubilados-card');
            jubiladosCard.querySelector('.h5').textContent = cantidadJubilados;

            const cantidadJubiladas = data.mujeres;
            const jubiladasCard = document.getElementById('jubiladas-card');
            jubiladasCard.querySelector('.h5').textContent = cantidadJubiladas;

            const TotalesCard = document.getElementById('jubilados-total');
            TotalesCard.querySelector('.h5').textContent = cantidadJubiladas + cantidadJubilados;




            // Actualiza el contenido de la tarjeta de Tramites iniciados
            const iniciadosCard = document.getElementById('iniciados-card');
            iniciadosCard.querySelector('.h5').textContent = data.iniciados;


            // Oculta el loader al finalizar la carga de datos
            document.getElementById('loader').style.display = 'none';
        } catch (error) {
            console.error('Error al obtener los datos de jubilados:', error);
        }
    }
    // Llama a la función para actualizar los datos al cargar la página
    actualizarDatosJubilados();
</script>






@endsection