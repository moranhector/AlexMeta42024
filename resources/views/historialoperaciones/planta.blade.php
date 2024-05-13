@extends('layouts.app')





<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>




<style>
    .formulario {
        max-width: 900px;
        /* Ajusta el ancho máximo según tus preferencias */
        margin: 0 auto;
        /* Centra el formulario en la página */
        padding: 20px;
        /* Añade un poco de espacio alrededor del formulario */
        background-color: #ffffff;
        /* Color de fondo opcional */
    }

    .formulario label {
        display: block;
        /* Hace que las etiquetas se muestren en una nueva línea */
        margin-bottom: 5px;
        /* Añade espacio entre las etiquetas y los campos de entrada */
    }

    .formulario input {
        width: 100%;
        /* Hace que los campos de entrada ocupen todo el ancho disponible */
        box-sizing: border-box;
        /* Incluye el padding y el borde en el ancho total */
        margin-bottom: 10px;
        /* Añade espacio entre los campos de entrada */
    }

    .formulario button {
        width: 100%;
        /* Hace que el botón ocupe todo el ancho disponible */
        box-sizing: border-box;
        /* Incluye el padding y el borde en el ancho total */
    }

    #map {
        height: 400px;
        width: 900px;
    }


    /* Estilo para la tabla */
    #table_personas {
        background-color: white;
        /* Fondo blanco */
        border-collapse: collapse;
        /* Para asegurar que las celdas se fusionen correctamente */
        width: 100%;
    }

    /* Estilo para las celdas */
    #table_personas th,
    #table_personas td {
        border: 1px solid #ddd;
        /* Línea gris fina entre celdas */
        padding: 8px;
        /* Espacio interno */
        text-align: left;
        /* Alineación del texto */
    }

    /* Estilo para los encabezados */
    #table_personas th {
        background-color: #007bff;
        /* Fondo azul */
        color: white;
        /* Texto negro */
        font-weight: bold;
        /* Texto en negrita */
        border-bottom: 2px solid black;
        /* Línea negra más gruesa en la parte inferior */
    }

    /* Estilo para el pie de tabla */
    #table_personas tfoot {
        background-color: #007bff;
        /* Fondo azul */
        color: white;
        /* Texto blanco */
        font-weight: bold;
        /* Texto en negrita */
    }
</style>








@section('content')

<!-- Main content -->




<section class="content container-fluid">


    <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
            <div class="panel-heading"><b>Altas por mes</b>
            </div>
            <div class="panel-body">
                <canvas id="canvasaltasbajas" height="580" width="1200"></canvas>
            </div>
        </div>
    </div>


    <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">

            <div class="panel-body">
                <button onclick="GraficoTotal()" id="btn_nivel1" class="btn btn-primary"> Atrás </button>
                <div id="canvas_distrib_uor">

                </div>
                <div id="canvas_distrib_uor2">

                </div>

            </div>

        </div>
    </div>






</section>



<script src="js/variables_entorno.js"></script>


<!-- DATATABLES -->
<script src="https://code.jquery.com/jquery-3.7.1.js"> </script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"> </script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"> </script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    $(document).ready(function() {
        // Activar tabs
        $('.nav-tabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>


<script>
    var map = L.map('map').setView([-32.8986, -68.8474], 13);



    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>


<script>
    // Inicialización del DataTable
    new DataTable('#table_personas', {
        language: {
            url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json' // Asegúrate de tener acceso a esta URL
        },
        // deferRender: true, // Retarda la carga de celdas hasta que son necesarias    
        searchDelay: 1000,
        ajax: SERVER_NODE + '/personas2',
        columns: [{
                data: 'SCO_GB_NAME'
            },
            {
                data: 'STD_SSN'
            },
            {
                data: 'STD_ID_PERSON'
            },
            {
                data: 'STD_ID_PERSON',
                render: function(data) {
                    // Agrega un botón en la columna y asocia la función exportToExcel
                    return '<button class="btn btn-primary export-button" data-std_id_person="' + data + '">' +
                        'Legajo' +
                        '</button>';
                }


            }
        ],

    });


    // Agrega un evento de clic utilizando delegación en el contenedor para manejar dinámicamente los botones
    document.querySelector('#table_personas').addEventListener('click', function(event) {
        if (event.target.classList.contains('export-button')) {
            // Obtiene la UOR desde el atributo data

            const std_id_person = event.target.dataset.std_id_person;
            console.log('std_id_person', event.target.dataset.std_id_person);
            mostrarFormulario(std_id_person);
            // Llama a la función exportToExcel con la URL y nombre del archivo
            //exportToExcel(SERVER_NODE + '/excel_jubilaciones_detalle_etiqueta/' + uor, 'jubilaciones_instituciones_' + uor + '.xlsx');
        }
    });
</script>
<script>
    function mostrarFormulario(stdIdPerson) {
        // Realizar la solicitud Ajax para obtener la información de la persona
        console.log('entro a mostrarformulario', stdIdPerson)
        //const endpoint = SERVER_NODE + '/personas_id';
        const endpoint = SERVER_NODE + '/personas_id_completo';

        // Realiza la solicitud Ajax con el ID de la persona
        fetch(`${endpoint}/${stdIdPerson}`)
            .then(response => response.json())
            .then(data => {
                console.log(' data ', data);
                console.log(' data.persona ', data.data.persona);

                if (data.data && data.data.persona.length > 0) {
                    const persona = data.data.persona[0];
                    const domicilio = data.data.domicilio[0];

                    console.log(' PERSONA ', data.data.persona[0]);
                    console.log(' DOMICILIO ', domicilio);
                    // Llena el formulario con los datos recibidos
                    document.getElementById('nombre').value = persona.SCO_GB_NAME;
                    document.getElementById('documento').value = persona.STD_SSN;
                    document.getElementById('id_persona').value = persona.STD_ID_PERSON;
                    // Otros campos
                    // Muestra el formulario
                    document.getElementById('formulario').style.display = 'block';
                    //DATOS DE DOMICILIO
                    document.getElementById('domicilio').value = domicilio.DOMICILIO;
                    document.getElementById('calle').value = domicilio.DOMI_CALLE;
                    document.getElementById('numero').value = domicilio.DOMI_NUMERO;
                    document.getElementById('lugar').value = domicilio.DOMI_LUGAR;
                    document.getElementById('cp').value = domicilio.DOMI_CP;


                } else {
                    console.error('No se encontraron datos para el ID de persona:', stdIdPerson);
                }

            })
            .catch(error => console.error('Error al obtener datos de la persona:', error));
    }
</script>



<script>
    function cerrarFormulario() {
        document.getElementById('formulario').style.display = 'none';
    }
</script>




<!-- 
╔═╗┬─┐┌─┐┌─┐┬┌─┐┌─┐┌─┐  ╔═╗┬ ┌┬┐┌─┐┌─┐  ╔╗ ┌─┐ ┬┌─┐┌─┐
║ ╦├┬┘├─┤├┤ ││  │ │└─┐  ╠═╣│  │ ├─┤└─┐  ╠╩╗├─┤ │├─┤└─┐
╚═╝┴└─┴ ┴└  ┴└─┘└─┘└─┘  ╩ ╩┴─┘┴ ┴ ┴└─┘  ╚═╝┴ ┴└┘┴ ┴└─┘
 -->


<script>
    var url = "{{url('http://localhost:3000/altasbajas/202303/202402')}}";


    var etiquetas = [];
    var altas = [];
    var bajas = [];
    var graficoAltasBajas; // Mueve la declaración aquí para que esté en un alcance más amplio



    var cantidades = [];


    $(document).ready(function() {

        console.log('entra a canvasaltasbajas');
        $.get(url, function(response) {

            const rowsData = response.rows; // Accede al array de objetos

            rowsData.forEach(function(row) {
                console.log('data:', row);
                etiquetas.push(row.PERIODO); // Cambio en la etiqueta
                altas.push(row.ALEX_ALTAS);
                bajas.push(row.ALEX_BAJAS);
                // cantidades.push(row.ALEX_ALTAS); // Cambio en la cantidad
            });



            var ctx = document.getElementById("canvasaltasbajas").getContext('2d');
            graficoAltasBajas = new Chart(ctx, {
                type: 'bar',

                data: {
                    labels: etiquetas,
                    datasets: [{
                        label: 'Altas Signos',
                        data: altas,
                        backgroundColor: '#33ECFF',
                        hoverBackgroundColor: '#3196C5',
                        borderColor: '#000000',
                        borderWidth: 2
                    }, {
                        label: 'Bajas Signos',
                        data: bajas,
                        backgroundColor: '#FF5733',
                        hoverBackgroundColor: '#C53126',
                        borderColor: '#000000',
                        borderWidth: 2
                    }]
                },



                options: {
                    title: {
                        display: true,
                        text: 'Altas por Periodo'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    onClick: function(event) {
                        handleClick(event, graficoAltasBajas)
                    },


                }
            });
        });
    });

    //     function handleClick(event) {
    //   const activeElement = graficoAltasBajas.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false)[0];
    //   if (activeElement) {
    //     // Aquí puedes llamar a tu función de JavaScript pasando el dato correspondiente
    //     console.log('Haz hecho clic en la etiqueta:', etiquetas[activeElement.index]);
    //   }

    function handleClick(event, chart) {
        const activeElement = chart.getElementsAtEventForMode(event, 'nearest', {
            intersect: true
        }, false)[0];
        if (activeElement) {
            const periodo = etiquetas[activeElement.index];
            alert('Haz hecho clic en la etiqueta: ' + periodo);
        }
    }
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




<!-- 
╔═╗┬─┐┌─┐┌─┐┬┌─┐┌─┐  ╔═╗┬  ┌─┐┌┐┌┌┬┐┌─┐
║ ╦├┬┘├─┤├┤ ││  │ │  ╠═╝│  ├─┤│││ │ ├─┤
╚═╝┴└─┴ ┴└  ┴└─┘└─┘  ╩  ┴─┘┴ ┴┘└┘ ┴ ┴ ┴
 -->


<script>
    // SEGUNDO NIVEL DEL GRAFICO
    function showDistribChart(selectedUOR) {

        var botonOcultar = document.getElementById("btn_nivel1");

        // Ocultar el div cambiando su estilo
        botonOcultar.style.display = "block";

        // Realiza una llamada a la API con el UOR seleccionado
        //console.log('showAnotherChart ', 'http://localhost:8000/uor-explode/' + selectedUOR);
        fetch(SERVER_NODE + '/planta_uor2?JUR=' + selectedUOR) // Reemplaza 'uor' con la URL correcta de tu API Laravel
            // fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_uor2?JUR=' + selectedUOR) // Reemplaza 'uor' con la URL correcta de tu API Laravel
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
                                previewExcel(SERVER_NODE + '/excel_jubilaciones_detalle_uor_todos/' + selectedUOR2);
                                //previewExcel('http://localhost:3000/excel_jubilaciones_detalle_uor_todos/' + selectedUOR2  );                                     
                                // Llamar a la función para mostrar el nuevo gráfico
                                //showDistribChart(selectedUOR);
                            },



                        }

                    }],
                    title: {
                        text: 'UOR:' + selectedUOR
                    }
                });

            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    }
</script>

<script>
    // PRIMER NIVEL DEL GRAFICO
    function GraficoTotal() {


        var botonOcultar = document.getElementById("btn_nivel1");

        // Ocultar el div cambiando su estilo
        botonOcultar.style.display = "none";

        fetch(SERVER_NODE + '/planta_uor')
            .then(response => response.json())
            .then(jsonData => {
                console.log(jsonData.data);
                var data = jsonData.data.map((item, index) => ({
                    name: item.UOR,
                    value: item.CANTIDAD,
                    colorValue: index,
                    color: getColorForIndex(index)
                }));

                function getColorForIndex(index) {
                    var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#FF4500', '#FFD700'];
                    return colors[index % colors.length];
                }

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
                                var selectedUOR = event.point.name;
                                showDistribChart(selectedUOR);
                            }
                        }
                    }],
                    title: {
                        text: 'Planta Total:'
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));


    }

    // Llamar a la función al cargar el DOM
    document.addEventListener("DOMContentLoaded", GraficoTotal);

    // Llamar a la función al hacer clic en el botón (reemplaza 'miBoton' con el ID de tu botón)
    //document.getElementById('miBoton').addEventListener('click', cargarDatosYCrearGrafico);
</script>





<script>
    function OLDshowDistribChart(selectedUOR) {
        // Realiza una llamada a la API con el UOR seleccionado
        //console.log('showAnotherChart ', 'http://localhost:8000/uor-explode/' + selectedUOR);
        fetch('http://dic-alex-tst.mendoza.gov.ar/uor-explode/' + selectedUOR) // Reemplaza 'uor' con la URL correcta de tu API Laravel
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
        fetch(SERVER_NODE + '/planta_uor/')
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

<!-- 
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
</script> -->




@endsection