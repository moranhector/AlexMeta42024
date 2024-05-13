@extends('layouts.app')

<!-- VERSION - ANTES MODAL 09:07-->
<!-- VERSION - ANTES MODAL -->


@section('content')

<section class="content container-fluid">

    <div class="row  tarjeta-container">



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
                <button onclick="exportToExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubi_infocompleta','jubilaciones_infocompleta.xlsx')">
                    Descargar informe <i class="fas fa-file-excel"></i>
                </button>

            </div>

        </div>



        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" id="jubilados-card">
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
                <button onclick="exportToExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubi_infocompleta/M','jubilaciones_infocompleta_hombres.xlsx')">
                    Descargar informe <i class="fas fa-file-excel"></i>
                </button>

            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" id="jubiladas-card">
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
                <button onclick="exportToExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubi_infocompleta/F','jubilaciones_infocompleta_mujeres.xlsx')">
                    Descargar informe <i class="fas fa-file-excel"></i>
                </button>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" id="iniciados-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Trámites iniciados último año
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <button onclick="exportToExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubi_infocompleta','jubilaciones_infocompleta.xlsx')">
                    Descargar informe <i class="fas fa-file-excel"></i>
                </button>

            </div>
        </div>




    </div>





    <div>

        <span id="loader" class="loader" style="display: none;"></span>

    </div>

    <!-- <div>

        <button onclick="exportToExcel('http://localhost:3000/jubilaciones_detalle/202310','jubilaciones.xlsx')">
            <i class="fas fa-file-excel"></i>
        </button>

    </div> -->
    <div class="panel-heading">
        <h2>Distribución por Jurisdicción</h2>
    </div>

    <!-- <div>


        <table id="myTable" data-toggle="table" data-url="http://localhost:3000/jubilaciones_detalle/202310" data-pagination="true" data-locale="es-ES" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th data-field="CUIL">CUIL </th>
                    <th data-field="NOMBREAPELLIDO">Nombre</th>
                    <th data-field="GENERO">Género</th>
                    <th data-field="FECHANACIMIENTO">Nacimiento</th>
                    <th data-field="FECHAINGRESO">Ingreso</th>

                </tr>
            </thead>
        </table>


    </div> -->

    <!-- JUBILACIONES POR UOR -->


    <!-- En tu archivo Blade -->



    <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
            <button onclick="restoreOriginalChart()">Regresar</button>


            <!-- <button onclick="exportToExcel('http://localhost:3000/excel_jubi_infocompleta','jubilaciones_infocompleta.xlsx')">
                <i class="fas fa-file-excel"></i>
            </button> -->
            <div class="panel-body">

                <div id="canvas_distrib_uor"></div>
                <div id="canvas_distrib_uor2"></div>

            </div>

 


        </div>
    </div>

    <!-- JUBILACIONES POR UOR - HOMBRES -->

    <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
            <div class="panel-heading">
                <!-- <b>Distribución por UOR - MASCULINO</b> -->
            </div>
            <div class="panel-body">

                <div id="canvas_jubilados"></div>


            </div>
        </div>
    </div>


    <!-- JUBILACIONES POR UOR MUJERES -->

    <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
            <div class="panel-heading">
                <!-- <b>Distribución por UOR - FEMENINO</b> -->
            </div>
            <div class="panel-body">

                <div id="canvas_jubiladas"></div>


            </div>
        </div>
    </div>




    <!-- <div id="previewTable">

    </div> -->

    <!-- La ventana modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="previewTable"></div>
        </div>
    </div>


</section>





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
            // iniciadosCard.querySelector('.h5').textContent = data.iniciados;
            iniciadosCard.querySelector('.h5').textContent = 'En análisis';


            // Oculta el loader al finalizar la carga de datos
            document.getElementById('loader').style.display = 'none';
        } catch (error) {
            console.error('Error al obtener los datos de jubilados:', error);
        }
    }
    // Llama a la función para actualizar los datos al cargar la página
    actualizarDatosJubilados();
</script>




<!-- JavaScript to initialize Bootstrap Table -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').bootstrapTable();
    });
</script>



<script>
    function exportToExcel(apiUrl, fileName) {
        // Hacer la solicitud AJAX a la API para obtener los datos
        console.log(' entra a export');


        fetch(`${apiUrl}`)
            .then(response => response.json())
            .then(data => {
                // Crear una hoja de cálculo
                // Crear una hoja de cálculo
                const workbook = XLSX.utils.book_new();


                // Dar formato a las celdas de encabezados
                const headerCellStyle = {
                    fill: {
                        fgColor: {
                            rgb: 'FFC000'
                        }, // Color de fondo (amarillo)
                    },
                    font: {
                        color: {
                            rgb: 'FFFFFF'
                        }, // Color de texto (blanco)
                        bold: true, // Texto en negrita
                    },
                };

                const worksheet = XLSX.utils.json_to_sheet(data.data, {
                    header: Object.keys(data.data[0])
                }); // Especificar los encabezados usando Object.keys(data[0])                
                console.log('Data received:', data.data); // Verifica la estructura de data en la consola

                const range = XLSX.utils.decode_range(worksheet['!ref']); // Obtener el rango de celdas
                for (let col = range.s.c; col <= range.e.c; col++) {
                    const cellAddress = XLSX.utils.encode_cell({
                        r: 0,
                        c: col
                    }); // Encabezado en la primera fila (r = 0)
                    worksheet[cellAddress].s = headerCellStyle; // Aplicar el estilo de encabezado a cada celda de la primera fila
                }

                // Dar formato numérico a las celdas de datos (desde la segunda fila en adelante)
                for (let row = range.s.r + 1; row <= range.e.r; row++) {
                    for (let col = range.s.c; col <= range.e.c; col++) {
                        const cellAddress = XLSX.utils.encode_cell({
                            r: row,
                            c: col
                        });
                        if (worksheet[cellAddress] && typeof worksheet[cellAddress].v === 'number') {
                            worksheet[cellAddress].t = 'n';
                            worksheet[cellAddress].z = "0.00"; // Formato numérico con dos decimales
                        }
                    }
                }

                // Agregar la hoja de cálculo al libro
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Hoja1');

                // Crear el archivo XLSX y convertirlo a un Blob
                const excelBuffer = XLSX.write(workbook, {
                    type: 'array',
                    bookType: 'xlsx'
                });
                const blob = new Blob([excelBuffer], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });

                // Crear un enlace para descargar el archivo
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = fileName; // Nombre del archivo personalizado
                a.click();

                // Liberar el objeto URL
                URL.revokeObjectURL(url);

            })
            .catch(error => console.error('Error al obtener los datos:', error));
    }
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
        fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_uor2?JUR=' + selectedUOR) // Reemplaza 'uor' con la URL correcta de tu API Laravel
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
                Highcharts.chart('canvas_distrib_uor2', {
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

                                previewExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubilaciones_detalle_uor_todos/' + selectedUOR2);
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



    // Función para restaurar el estado original
    function restoreOriginalChart() {

        var divParaOcultar = document.getElementById("canvas_distrib_uor2");

        // Ocultar el div cambiando su estilo
        divParaOcultar.style.display = "none";

        var divParaOcultar = document.getElementById("canvas_distrib_uor");

        // Ocultar el div cambiando su estilo
        divParaOcultar.style.display = "block";

    }


    // Función para restaurar el estado original
    function showSecondaryChart() {

        var divParaOcultar = document.getElementById("canvas_distrib_uor2");

        // Ocultar el div cambiando su estilo
        divParaOcultar.style.display = "block";

        var divParaOcultar = document.getElementById("canvas_distrib_uor");

        // Ocultar el div cambiando su estilo
        divParaOcultar.style.display = "none";

    }



    document.addEventListener("DOMContentLoaded", function() {
        // Obtener los datos desde la API REST en Laravel
        fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_uor')
            //fetch('http://localhost:3000/jubilaciones_uor')
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el gráfico
                console.log(jsonData.data);
                var data = jsonData.data.map((item, index) => ({
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

                                var divParaOcultar = document.getElementById("canvas_distrib_uor");

                                // Ocultar el div cambiando su estilo
                                divParaOcultar.style.display = "none";

                            }
                        }
                    }],
                    title: {
                        text: 'Mujeres y Hombres:'
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));

        saveOriginalChartState();
    });
</script>


<!-- GRAFICO DISTRIBUCION POR UOR SOLO HOMBRES -->

<!-- 
██╗  ██╗ ██████╗ ███╗   ███╗██████╗ ██████╗ ███████╗███████╗
██║  ██║██╔═══██╗████╗ ████║██╔══██╗██╔══██╗██╔════╝██╔════╝
███████║██║   ██║██╔████╔██║██████╔╝██████╔╝█████╗  ███████╗
██╔══██║██║   ██║██║╚██╔╝██║██╔══██╗██╔══██╗██╔══╝  ╚════██║
██║  ██║╚██████╔╝██║ ╚═╝ ██║██████╔╝██║  ██║███████╗███████║
╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚═╝╚═════╝ ╚═╝  ╚═╝╚══════╝╚══════╝
                                                             -->


<script>
    function showDistribChartM(selectedUOR) {
        // Realiza una llamada a la API con el UOR seleccionado
        fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_uor_gen2?JUR=' + selectedUOR + '&GEN=' + 'M') // Reemplaza 'uor' con la URL correcta de tu API Laravel        
            //fetch('http://localhost:3000/jubilaciones_uor_gen2?JUR=' + selectedUOR +'&GEN=' + 'M' ) // Reemplaza 'uor' con la URL correcta de tu API Laravel                
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
                    //var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#FF4500', '#FFD700'];
                    var colors = ['#4169E1', '#1E90FF', '#00BFFF', '#87CEEB', '#ADD8E6', '#00CED1', '#4682B4'];

                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el nuevo gráfico TreeMap
                Highcharts.chart('canvas_jubilados', {
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
                                previewExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubilaciones_detalle_uor/' + selectedUOR2 + '/M');
                                //previewExcel('http://localhost:3000/excel_jubilaciones_detalle_uor/' + selectedUOR2 +'/M' );                                 

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
        fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_uor_gen' + '?GEN=' + 'M')
            //fetch('http://localhost:3000/jubilaciones_uor_gen' +'?GEN=' + 'M'  )
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el gráfico
                console.log(jsonData.data);
                var data = jsonData.data.map((item, index) => ({
                    name: item.UOR,
                    value: item.CANTIDAD,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));

                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    //var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#FF4500', '#FFD700'];
                    var colors = ['#4169E1', '#1E90FF', '#00BFFF', '#87CEEB', '#ADD8E6', '#00CED1', '#4682B4'];

                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el gráfico TreeMap
                Highcharts.chart('canvas_jubilados', {
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
                                showDistribChartM(selectedUOR);
                            }
                        }
                    }],
                    title: {
                        text: 'Hombres:'
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    });
</script>


<!-- MUJERES  -->
<!-- 
███╗   ███╗██╗   ██╗     ██╗███████╗██████╗ ███████╗███████╗
████╗ ████║██║   ██║     ██║██╔════╝██╔══██╗██╔════╝██╔════╝
██╔████╔██║██║   ██║     ██║█████╗  ██████╔╝█████╗  ███████╗
██║╚██╔╝██║██║   ██║██   ██║██╔══╝  ██╔══██╗██╔══╝  ╚════██║
██║ ╚═╝ ██║╚██████╔╝╚█████╔╝███████╗██║  ██║███████╗███████║
╚═╝     ╚═╝ ╚═════╝  ╚════╝ ╚══════╝╚═╝  ╚═╝╚══════╝╚══════╝
                                                              -->


<script>
    function showDistribChartF(selectedUOR) {
        fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_uor_gen2?JUR=' + selectedUOR + '&GEN=' + 'F') // Reemplaza 'uor' con la URL correcta de tu API Laravel        
            //fetch('http://localhost:3000/jubilaciones_uor_gen2?JUR=' + selectedUOR +'&GEN=' + 'F' ) // Reemplaza 'uor' con la URL correcta de tu API Laravel        
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
                    //var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#FF4500', '#FFD700'];
                    var colors = ['#FFC0CB', '#FF69B4', '#FF1493', '#FF007F', '#E6E6FA', '#FFA07A', '#F08080'];

                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el nuevo gráfico TreeMap
                Highcharts.chart('canvas_jubiladas', {
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
                                console.log('preview excel femenino', encodedUOR2);
                                previewExcel('http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubilaciones_detalle_uor/' + selectedUOR2 + '/F');
                                //previewExcel('http://localhost:3000/excel_jubilaciones_detalle_uor/' + selectedUOR2 +'/F' );                                

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
        fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_uor_gen' + '?GEN=' + 'F')
            //fetch('http://localhost:3000/jubilaciones_uor_gen' +'?GEN=' + 'F'  )
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el gráfico
                console.log(jsonData.data);
                var data = jsonData.data.map((item, index) => ({
                    name: item.UOR,
                    value: item.CANTIDAD,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));

                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    //var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#FF4500', '#FFD700'];
                    var colors = ['#FFC0CB', '#FF69B4', '#FF1493', '#FF007F', '#E6E6FA', '#FFA07A', '#F08080'];
                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el gráfico TreeMap
                Highcharts.chart('canvas_jubiladas', {
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
                                showDistribChartF(selectedUOR);
                            }
                        }
                    }],
                    title: {
                        text: 'Mujeres:'
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    });
</script>








<script>
    function createTable(data, apiUrl) {
        console.log('que datos vienen', data);
        var html = '<table border="1">';
        html += '<thead>';
        html += '<tr class="excel-button-row"><th colspan="3"><button onclick="exportToExcelFromModal(\'' + apiUrl + '\')"><i class="fas fa-file-excel"></i></button></th></tr>'; // Botón en el encabezado
        html += 'Registros: ' + data.length;
        html += '<tr>';
        html += '<th>CUIT</th>';
        html += '<th>NOMBRE</th>';
        html += '<th>EDAD</th>';
        html += '<th>DEPENDENCIA</th>';
        html += ' <th>DESCRIPCION</th>';
        html += '<th>RATS</th>';
        html += '<th>CLASE</th>';
        html += '<th>FECHA INGRESO</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        for (var i = 0; i < data.length; i++) {
            html += '<tr>';
            html += '<td>' + data[i].CUIL + '</td>';
            html += '<td>' + data[i].NOMBREAPELLIDO + '</td>';
            html += '<td>' + data[i].EDAD + '</td>';
            html += '<td>' + data[i].DEPENDENCIA + '</td>';
            html += '<td>' + data[i].DESCRIPCIONUOR + '</td>';
            html += '<td>' + data[i].RATS + '</td>';
            html += '<td>' + data[i].CLASE + '</td>';
            html += '<td>' + data[i].FECHAINGRESO + '</td>';
            html += '</tr>';
        }
        html += '</tbody>';
        html += '</table>';
        return html;
    }
</script>





<script>
    function previewExcelOld(apiUrl) {
        // Hacer la solicitud AJAX a la API para obtener los datos
        console.log(' entra a preview');


        fetch(`${apiUrl}`)
            .then(response => response.json())
            .then(data => {


                console.log('Data received:', data.data); // Verifica la estructura de data en la consola

                var jsonData = data.data;

                var previewTable = document.getElementById('previewTable');
                previewTable.innerHTML = createTable(jsonData);



            })
            .catch(error => console.error('Error al obtener los datos:', error));
    }
</script>

<script>
    function previewExcel(apiUrl) {
        // Hacer la solicitud AJAX a la API para obtener los datos
        fetch(`${apiUrl}`)
            .then(response => response.json())
            .then(data => {
                var jsonData = data.data;
                var previewTable = document.getElementById('previewTable');
                previewTable.innerHTML = createTable(jsonData, apiUrl);

                // Mostrar la ventana modal después de cargar los datos
                openModal();
            })
            .catch(error => console.error('Error al obtener los datos:', error));
    }

    // Función para abrir la ventana modal
    function openModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';
    }

    // Función para cerrar la ventana modal
    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }
</script>

<script>
    function exportToExcelFromModal(apiUrl) {
        // Hacer la solicitud AJAX a la API para obtener los datos
        console.log(' entra a export');


        fetch(`${apiUrl}`)
            .then(response => response.json())
            .then(data => {
                // Crear una hoja de cálculo
                // Crear una hoja de cálculo
                const workbook = XLSX.utils.book_new();


                // Dar formato a las celdas de encabezados
                const headerCellStyle = {
                    fill: {
                        fgColor: {
                            rgb: 'FFC000'
                        }, // Color de fondo (amarillo)
                    },
                    font: {
                        color: {
                            rgb: 'FFFFFF'
                        }, // Color de texto (blanco)
                        bold: true, // Texto en negrita
                    },
                };

                const worksheet = XLSX.utils.json_to_sheet(data.data, {
                    header: Object.keys(data.data[0])
                }); // Especificar los encabezados usando Object.keys(data[0])                
                console.log('Data received:', data.data); // Verifica la estructura de data en la consola

                const range = XLSX.utils.decode_range(worksheet['!ref']); // Obtener el rango de celdas
                for (let col = range.s.c; col <= range.e.c; col++) {
                    const cellAddress = XLSX.utils.encode_cell({
                        r: 0,
                        c: col
                    }); // Encabezado en la primera fila (r = 0)
                    worksheet[cellAddress].s = headerCellStyle; // Aplicar el estilo de encabezado a cada celda de la primera fila
                }

                // Dar formato numérico a las celdas de datos (desde la segunda fila en adelante)
                for (let row = range.s.r + 1; row <= range.e.r; row++) {
                    for (let col = range.s.c; col <= range.e.c; col++) {
                        const cellAddress = XLSX.utils.encode_cell({
                            r: row,
                            c: col
                        });
                        if (worksheet[cellAddress] && typeof worksheet[cellAddress].v === 'number') {
                            worksheet[cellAddress].t = 'n';
                            worksheet[cellAddress].z = "0.00"; // Formato numérico con dos decimales
                        }
                    }
                }

                // Agregar la hoja de cálculo al libro
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Hoja1');

                // Crear el archivo XLSX y convertirlo a un Blob
                const excelBuffer = XLSX.write(workbook, {
                    type: 'array',
                    bookType: 'xlsx'
                });
                const blob = new Blob([excelBuffer], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });

                // Crear un enlace para descargar el archivo
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'jubilaciones_export'; // Nombre del archivo personalizado
                a.click();

                // Liberar el objeto URL
                URL.revokeObjectURL(url);

            })
            .catch(error => console.error('Error al obtener los datos:', error));
    }
</script>

<script>
    function refreshPage() {
        // Recarga la página
        location.reload(true);
    }
</script>



@endsection