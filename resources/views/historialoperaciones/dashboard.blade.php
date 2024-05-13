@extends('layouts.app')

<!-- VERSION - ANTES MODAL 09:07-->
<!-- VERSION - ANTES MODAL -->

@section('content')

<section class="content container-fluid">

    <div class="row  tarjeta-container">



        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" id="planta-total">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Planta Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>



                        </div>
                        <div class="col-auto">

                            <i class="fas fa-male fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" id="planta-hombres">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Hombres </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>



                        </div>
                        <div class="col-auto">

                            <i class="fas fa-male fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" id="planta-mujeres">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Mujeres</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>



                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        


    </div>

<!-- TARJETA ULTIMA ACTUALIZACION -->

<div class="col-xl-3 col-md-6 mb-8">

<div class="card border-left-primary shadow h-40 py-2">
    <div class="card-body">

        <!-- INFO PERIODO -->
        <div class="periodo-info" id="card-periodo" >
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Datos Mes</div>
                                              
                        <div class="h5 mb-0 font-weight-bold text-gray-800">   </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- INFO DIA -->
        <div class="info-dia" id="card-fecha">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Fecha</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>

            </div>
        </div>



    </div>
</div>
</div>




    <!-- JUBILACIONES POR UOR -->

    <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
            <div class="panel-heading"><b>Distribución por UOR TOTAL</b>
            </div>
            <div class="panel-body">
                
                    <div id="canvas_distrib_uor"></div>

         
            </div>
        </div>
    </div>





    <div>

        <span id="loader" class="loader" style="display: none;"></span>

    </div>




</section>

 

<script src="js/variables_entorno.js"></script>

 



<script>
    async function actualizarDatosPlanta() {
        try {
            // Mostrar el loader al iniciar la carga de datos
            document.getElementById('loader').style.display = 'block';
            console.log(  ' Entro a actualizar jubilados') ;
            //const response = await fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_v3');
            const response = await fetch( SERVER_NODE+'/planta');
            const data = await response.json();

            console.log( 'datos' , data );

            const PlantaTotal = data.totales;
            const Periodo = data.periodo ;
            const fechaProcesado = data.fechaProcesado ;
            const dPlantaHombres = data.plantahombres ;            
            const dPlantaMujeres = data.plantamujeres ;            
            // const jubiladosCard = document.getElementById('jubilados-card');
            // jubiladosCard.querySelector('.h5').textContent = cantidadJubilados;

            // const cantidadJubiladas = data.mujeres;
            // const jubiladasCard = document.getElementById('jubiladas-card');
            // jubiladasCard.querySelector('.h5').textContent = cantidadJubiladas;

            const TotalesCard = document.getElementById('planta-total');
            TotalesCard.querySelector('.h5').textContent = PlantaTotal ;

            const PlantaHombres = document.getElementById('planta-hombres');
            PlantaHombres.querySelector('.h5').textContent = dPlantaHombres ;            

            const PlantaMujeres = document.getElementById('planta-mujeres');
            PlantaMujeres.querySelector('.h5').textContent = dPlantaMujeres ;               



            const PeriodoCard = document.getElementById('card-periodo');
            PeriodoCard.querySelector('.h5').textContent = Periodo ;


            const FechaCard = document.getElementById('card-fecha');
            FechaCard.querySelector('.h5').textContent = fechaProcesado ;



            // Actualiza el contenido de la tarjeta de Tramites iniciados
            // const iniciadosCard = document.getElementById('iniciados-card');
            // iniciadosCard.querySelector('.h5').textContent = data.iniciados;


            // Oculta el loader al finalizar la carga de datos
            document.getElementById('loader').style.display = 'none';
        } catch (error) {
            console.error('Error al obtener los datos de jubilados:', error);
        }
    }
    // Llama a la función para actualizar los datos al cargar la página
    actualizarDatosPlanta();
</script>



<!-- 
████████╗ ██████╗ ████████╗ █████╗ ██╗     ███████╗███████╗
╚══██╔══╝██╔═══██╗╚══██╔══╝██╔══██╗██║     ██╔════╝██╔════╝
   ██║   ██║   ██║   ██║   ███████║██║     █████╗  ███████╗
   ██║   ██║   ██║   ██║   ██╔══██║██║     ██╔══╝  ╚════██║
   ██║   ╚██████╔╝   ██║   ██║  ██║███████╗███████╗███████║
   ╚═╝    ╚═════╝    ╚═╝   ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝
                                                            -->


                                                            <script>
    function showDistribChart(selectedUOR) {
        // Realiza una llamada a la API con el UOR seleccionado
        //console.log('showAnotherChart ', 'http://localhost:8000/uor-explode/' + selectedUOR);
        fetch( SERVER_NODE + '/planta_uor2?JUR=' + selectedUOR ) // Reemplaza 'uor' con la URL correcta de tu API Laravel
        //fetch('http://localhost:3000/jubilaciones_uor2?JUR=' + selectedUOR ) // Reemplaza 'uor' con la URL correcta de tu API Laravel        
        
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el nuevo gráfico
                var newData = jsonData.data.map((item, index) => ({
                    name: item.UOR,
                    value: item.CANTIDAD,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));


                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#FF4500', '#FFD700'];
                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el nuevo gráfico TreeMap
                Highcharts.chart('canvas_distrib_uor', {
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
                            text: 'UOR: ' + selectedUOR
                        },
                        events: {
                            click: function(event) {
                                // Obtener el UOR seleccionado
                                //var selectedUOR = event.point.name;

                                //alert('Clic en el sector: ' +  selectedUOR );                            
                                var selectedUOR2 = event.point.name;   
                                var encodedUOR2 = encodeURIComponent(selectedUOR2);
                                console.log('event point name', encodedUOR2);    


                                //alert('Clic en el sector: ', selectedUOR2 );                                                            
                               

                                //previewExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubilaciones_detalle_uor/' + selectedUOR2 );
                                
                                previewExcel( SERVER_NODE + '/excel_jubilaciones_detalle_uor_todos/' + selectedUOR2  );                                     
                                //previewExcel('http://localhost:3000/excel_jubilaciones_detalle_uor_todos/' + selectedUOR2  );                                     

                                

                                // Llamar a la función para mostrar el nuevo gráfico
                                //showDistribChart(selectedUOR);
                            }
                        }


                    }],
                    title: {
                        text: 'UOR:' + selectedUOR
                    }
                });






            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Obtener los datos desde la API REST en Laravel
        fetch(  SERVER_NODE + '/planta_uor')
        //fetch('http://localhost:3000/jubilaciones_uor')
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el gráfico
                console.log( jsonData.data );
                var data = jsonData.data.map((item, index) => ({
                    name: item.UOR ,
                    value: item.CANTIDAD ,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));

                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#FF4500', '#FFD700'];
                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el gráfico TreeMap
                Highcharts.chart('canvas_distrib_uor', {
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
                                showDistribChart(selectedUOR);
                            }
                        }
                    }],
                    title: {
                        text: 'Total:'
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    });
</script>







<!-- JavaScript to initialize Bootstrap Table -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').bootstrapTable();
    });
</script>


 


@endsection