@extends('layouts.app')

<!-- VERSION - ANTES MODAL 09:07-->
<!-- VERSION - ANTES MODAL -->


@section('content')

<section class="content container-fluid">


    <div class="row  tarjeta-container">



        <div class="col-xl-3 col-md-6 my-4">

            <div class="card border-left-primary shadow h-40 py-2">
                <div class="card-body">

                    <!-- INFO PERIODO -->
                    <div class="periodo-info" id="card-periodo">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Actualizados a mes</div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>
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

    </div>


    <div class="row  tarjeta-container">



        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" id="jubilados-total">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Empleados con edad de jubilarse</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>



                        </div>
                        <div class="col-auto">

                            <i class="fas fa-male fa-2x text-gray-300"></i>

                        </div>


                    </div>


                </div>
                <button onclick="exportToExcel(SERVER_NODE+'/excel_jubi_infocompleta','jubilaciones_infocompleta.xlsx')">
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
                <button onclick="exportToExcel(SERVER_NODE+'/excel_jubi_infocompleta/M','jubilaciones_infocompleta_hombres.xlsx')">
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
                <button onclick="exportToExcel(SERVER_NODE+'/excel_jubi_infocompleta/F','jubilaciones_infocompleta_mujeres.xlsx')">
                    Descargar informe <i class="fas fa-file-excel"></i>
                </button>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" id="iniciados-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Trámites iniciados
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
                <!-- tramites iniciados -->

                <!-- <button onclick="exportToExcel(SERVER_NODE+'/excel_tramites','excel_tramites.xlsx')">
                    Descargar informe <i class="fas fa-file-excel"></i>
                </button> -->

                <!-- <button onclick="exportTo2Excel(SERVER_NODE+'/excel_tramites',
                SERVER_NODE+'/excel_tramites',
                'excel_tramites_extendido.xlsx')">
                    Descargar informe 2 <i class="fas fa-file-excel"></i>
                </button> -->

                <button onclick="exportTo3Excel(SERVER_NODE+'/excel_tramites',
                'Tramites_Iniciados',
                SERVER_NODE+'/excel_tramites_detallado',
                'Detalle_Tramites',                
                SERVER_NODE+'/excel_sin_tramites',    
                'Sin_tramite_iniciado',                                            
                'Tramites_proceso_jubilatorio.xlsx')">
                    Descargar informe <i class="fas fa-file-excel"></i>
                </button>


            </div>
        </div>




    </div>





    <div>

        <span id="loader" class="loader" style="display: none;"></span>

    </div>


    <div class="panel-heading">
        <h2>Distribución por Jurisdicción</h2>
    </div>



    <!-- JUBILACIONES POR UOR -->



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

    <!-- JUBILACIONES POR UOR - HOMBRES -->

    <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
            <div class="panel-heading">
                <!-- <b>Distribución por UOR - MASCULINO</b> -->
            </div>


            <div class="panel-body">
                <button onclick="GraficoHombres()" id="btn_hombres_nivel1" class="btn btn-primary"> Atrás </button>


                <div id="canvas_jubilados"></div>

                <div id="canvas_jubilados_nivel2"></div>



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
                <button onclick="GraficoMujeres()" id="btn_mujeres_nivel1" class="btn btn-primary"> Atrás </button>


                <div id="canvas_jubiladas"></div>

                <div id="canvas_jubiladas_nivel2"></div>



            </div>


        </div>
    </div>





    <div class="col-xl-12 col-md-6 my-4">





        <div class="card border-left-primary shadow h-40 py-2">


        
            <div class="card-body">


            <div class="panel-heading">
        <h2>Reportes por Ministerios / Unidades Organizativas</h2>
    </div>



                <table id="table_instituciones" class="secondary" style="width:100%">
                    <thead class="table-dark">

                        <tr class="table-dark">
                            <th>Unidad Organizativa</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                            <th>Editar</th>

                        </tr>
                    </thead>
                    <tfoot>

                        <tr class="table-dark">
                            <th>&nbsp; </th>
                            <th>&nbsp; </th>
                            <th>&nbsp; </th>
                            <th>&nbsp; </th>


                        </tr>
                    </tfoot>
                </table>


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

<script src="js/variables_entorno.js"></script>


<!-- DATATABLES -->
<script src="https://code.jquery.com/jquery-3.7.1.js"> </script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"> </script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"> </script>


<script>
    // Inicialización del DataTable
    new DataTable('#table_instituciones', {
        language: {
            url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json' // Asegúrate de tener acceso a esta URL
        },
        ajax: SERVER_NODE + '/instituciones',
        columns: [{
                data: 'UOR'
            },
            {
                data: 'CANTIDAD'
            },
            {
                data: 'UOR',
                render: function(data) {
                    // Agrega un botón en la columna y asocia la función exportToExcel
                    return '<button class="export-button" data-uor="' + data + '">' +
                        'Descargar informe <i class="fas fa-file-excel"></i>' +
                        '</button>';
                }
            },
            {
                data: 'UOR',
                render: function(data) {
                    // Agrega un botón en la columna y asocia la función para redirigir a la vista de edición
                    return '<button class="edit-button" data-uor="' + data + '">' +
                        'Editar informe <i class="fas fa-edit"></i>' +
                        '</button>';
                }
            }          

        ]
    });


    // // Agrega un evento de clic utilizando delegación en el contenedor para manejar dinámicamente los botones
    // document.querySelector('#table_instituciones').addEventListener('click', function(event) {
    //     if (event.target.classList.contains('export-button')) {
    //         // Obtiene la UOR desde el atributo data

    //         const uor = event.target.dataset.uor;
    //         console.log('uor', event.target.dataset.uor);
    //         // Llama a la función exportToExcel con la URL y nombre del archivo
    //         exportToExcel( SERVER_NODE + '/excel_jubilaciones_detalle_etiqueta/' + uor, 'jubilaciones_instituciones_' + uor + '.xlsx');
    //     }
    // });

        // Agrega un evento de clic utilizando delegación en el contenedor para manejar dinámicamente los botones
        document.querySelector('#table_instituciones').addEventListener('click', function(event) {
        if (event.target.classList.contains('export-button')) {
            // Obtiene la UOR desde el atributo data
            const uor = event.target.dataset.uor;
            console.log('uor', event.target.dataset.uor);
            // Llama a la función exportToExcel con la URL y nombre del archivo
            exportToExcel(SERVER_NODE + '/excel_jubilaciones_detalle_etiqueta/' + uor, 'jubilaciones_instituciones_' + uor + '.xlsx');
        } else if (event.target.classList.contains('edit-button')) {
            // Obtiene la UOR desde el atributo data
            const uor = event.target.dataset.uor;
            // Redirige al método index del controlador FuturoJubiladoController
            window.location.href = '/futurojubilado?uor=' + uor;
        }
    });



</script>






<script>
    async function actualizarDatosJubilados() {
        try {
            // Mostrar el loader al iniciar la carga de datos
            document.getElementById('loader').style.display = 'block';

            //const response = await fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_v3');
            const response = await fetch(SERVER_NODE + '/jubilaciones_v3');
            const data = await response.json();



            const cantidadJubilados = data.hombres;
            const jubiladosCard = document.getElementById('jubilados-card');
            jubiladosCard.querySelector('.h5').textContent = cantidadJubilados;

            const cantidadJubiladas = data.mujeres;
            const jubiladasCard = document.getElementById('jubiladas-card');
            jubiladasCard.querySelector('.h5').textContent = cantidadJubiladas;

            const TotalesCard = document.getElementById('jubilados-total');
            TotalesCard.querySelector('.h5').textContent = cantidadJubiladas + cantidadJubilados;


            const cantidadTramites = data.iniciados;

            // Actualiza el contenido de la tarjeta de Tramites iniciados
            const iniciadosCard = document.getElementById('iniciados-card');
            // iniciadosCard.querySelector('.h5').textContent = data.iniciados;
            iniciadosCard.querySelector('.h5').textContent = cantidadTramites;


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






                // const worksheet = XLSX.utils.json_to_sheet(data.data, { header: Object.keys(data.data[0]) });


                // Crear la hoja de cálculo con los datos
                const worksheet = XLSX.utils.json_to_sheet(data.data, {
                    header: Object.keys(data.data[0])
                });


                // const worksheet = XLSX.utils.json_to_sheet(data.data, {
                //     header: Object.keys(data.data[0])
                // }); // Especificar los encabezados usando Object.keys(data[0])                
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





                // Agregar título de encabezado
                // const title = 'Título del Informe';
                const title = fileName;
                const titleCellStyle = {
                    font: {
                        color: {
                            rgb: '000000' // Color de texto negro
                        },
                        bold: true,
                        size: 14 // Tamaño de la fuente
                    },
                    alignment: {
                        horizontal: 'center' // Alineación centrada
                    },
                };
                const titleRow = XLSX.utils.json_to_sheet([{
                    A: title
                }], {
                    skipHeader: true
                });
                XLSX.utils.sheet_add_json(titleRow, [{
                    A: null
                }], {
                    skipHeader: true,
                    origin: 'A2'
                }); // Agregar fila en A2
                XLSX.utils.sheet_add_json(titleRow, [{
                    A: null
                }], {
                    skipHeader: true,
                    origin: 'A3'
                }); // Agregar fila en A3
                XLSX.utils.book_append_sheet(workbook, titleRow, 'Título');







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
    // SEGUNDO NIVEL DEL GRAFICO
    function showDistribChart(selectedUOR) {

        var botonOcultar = document.getElementById("btn_nivel1");

        // Ocultar el div cambiando su estilo
        botonOcultar.style.display = "block";

        // Realiza una llamada a la API con el UOR seleccionado
        //console.log('showAnotherChart ', 'http://localhost:8000/uor-explode/' + selectedUOR);
        fetch(SERVER_NODE + '/jubilaciones_uor2?JUR=' + selectedUOR) // Reemplaza 'uor' con la URL correcta de tu API Laravel
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

        fetch(SERVER_NODE + '/jubilaciones_uor')
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
                        text: 'Mujeres y Hombres:'
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


        var botonOcultar = document.getElementById("btn_hombres_nivel1");

        // Ocultar el div cambiando su estilo
        botonOcultar.style.display = "block";



        // Realiza una llamada a la API con el UOR seleccionado
        fetch(SERVER_NODE + '/jubilaciones_uor_gen2?JUR=' + selectedUOR + '&GEN=' + 'M') // Reemplaza 'uor' con la URL correcta de tu API Laravel        
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
                                previewExcel(SERVER_NODE + '/excel_jubilaciones_detalle_uor/' + selectedUOR2 + '/M');
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
</script>

<script>
    function GraficoHombres() {


        var botonOcultar = document.getElementById("btn_hombres_nivel1");

        // Ocultar el div cambiando su estilo
        botonOcultar.style.display = "none";


        // Obtener los datos desde la API REST en Laravel
        fetch(SERVER_NODE + '/jubilaciones_uor_gen' + '?GEN=' + 'M')
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
    }

    // Llamar a la función al cargar el DOM
    document.addEventListener("DOMContentLoaded", GraficoHombres);
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

        var botonOcultar = document.getElementById("btn_mujeres_nivel1");

        // Ocultar el div cambiando su estilo
        botonOcultar.style.display = "block";


        fetch(SERVER_NODE + '/jubilaciones_uor_gen2?JUR=' + selectedUOR + '&GEN=' + 'F') // Reemplaza 'uor' con la URL correcta de tu API Laravel        
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
                                previewExcel(SERVER_NODE + '/excel_jubilaciones_detalle_uor/' + selectedUOR2 + '/F');
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
</script>

<script>
    function GraficoMujeres() {

        var botonOcultar = document.getElementById("btn_mujeres_nivel1");

        // Ocultar el div cambiando su estilo
        botonOcultar.style.display = "none";


        // Obtener los datos desde la API REST en Laravel
        fetch(SERVER_NODE + '/jubilaciones_uor_gen' + '?GEN=' + 'F')
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
    }

    // Llamar a la función al cargar el DOM
    document.addEventListener("DOMContentLoaded", GraficoMujeres);
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

    function loaderOn() {
        document.getElementById('loader').style.display = 'block';
    }

    function loaderOff() {
        document.getElementById('loader').style.display = 'none';
    }
</script>

<script>
    async function actualizarPeriodo() {
        try {
            // Mostrar el loader al iniciar la carga de datos
            document.getElementById('loader').style.display = 'block';
            console.log(' Entro a actualizar jubilados');
            //const response = await fetch('http://dic-alex-tst.mendoza.gov.ar:3000/jubilaciones_v3');
            const response = await fetch(SERVER_NODE + '/planta');
            const data = await response.json();

            console.log('datos', data);

            const PlantaTotal = data.totales;
            const Periodo = data.periodo;
            const fechaProcesado = data.fechaProcesado;
            const dPlantaHombres = data.plantahombres;
            const dPlantaMujeres = data.plantamujeres;


            var fechaActualizacion = localStorage.getItem('fechaActualizacion');

            // Si no existe, establecerla con la fecha actual
            if (!fechaActualizacion) {
                //fechaActualizacion = new Date().toLocaleString();
                fechaActualizacion = fechaProcesado;
                localStorage.setItem('fechaActualizacion', fechaActualizacion);
            }

            // Puedes usar la variable fechaActualizacion en tu código JavaScript
            console.log('Fecha de actualización:', fechaActualizacion);



            const PeriodoCard = document.getElementById('card-periodo');
            PeriodoCard.querySelector('.h5').textContent = Periodo;

            const FechaCard = document.getElementById('card-fecha');
            FechaCard.querySelector('.h5').textContent = fechaProcesado;

            // Oculta el loader al finalizar la carga de datos
            document.getElementById('loader').style.display = 'none';
        } catch (error) {
            console.error('Error al obtener los datos de jubilados:', error);
        }
    }
    // Llama a la función para actualizar los datos al cargar la página
    actualizarPeriodo();
</script>


<script>
    function Old_exportTo2Excel(apiUrl, apiUrl2, fileName) {
        // Hacer la solicitud AJAX a la API para obtener los datos

        fetch(`${apiUrl}`)
            .then(response => response.json())
            .then(data => {

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

                // Crear la hoja de cálculo con los datos
                const worksheet = XLSX.utils.json_to_sheet(data.data, {
                    header: Object.keys(data.data[0])
                });

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

                // Agregar título de encabezado
                // const title = 'Título del Informe';
                const title = fileName;
                const titleCellStyle = {
                    font: {
                        color: {
                            rgb: '000000' // Color de texto negro
                        },
                        bold: true,
                        size: 14 // Tamaño de la fuente
                    },
                    alignment: {
                        horizontal: 'center' // Alineación centrada
                    },
                };
                const titleRow = XLSX.utils.json_to_sheet([{
                    A: title
                }], {
                    skipHeader: true
                });
                XLSX.utils.sheet_add_json(titleRow, [{
                    A: null
                }], {
                    skipHeader: true,
                    origin: 'A2'
                }); // Agregar fila en A2
                XLSX.utils.sheet_add_json(titleRow, [{
                    A: null
                }], {
                    skipHeader: true,
                    origin: 'A3'
                }); // Agregar fila en A3
                XLSX.utils.book_append_sheet(workbook, titleRow, 'Título');

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




<script>
    function exportTo2Excel(apiUrl, apiUrl2, fileName) {
        // Hacer la solicitud AJAX a la primera API para obtener los datos
        fetch(`${apiUrl}`)
            .then(response => response.json())
            .then(data => {
                // Crear una hoja de cálculo
                const workbook = XLSX.utils.book_new();

                // Crear la hoja de cálculo con los datos de la primera API
                const worksheet1 = XLSX.utils.json_to_sheet(data.data, {
                    header: Object.keys(data.data[0])
                });
                XLSX.utils.book_append_sheet(workbook, worksheet1, 'Hoja1');

                // Hacer la solicitud AJAX a la segunda API para obtener los datos
                fetch(`${apiUrl2}`)
                    .then(response2 => response2.json())
                    .then(data2 => {
                        // Crear la hoja de cálculo con los datos de la segunda API
                        const worksheet2 = XLSX.utils.json_to_sheet(data2.data, {
                            header: Object.keys(data2.data[0])
                        });
                        XLSX.utils.book_append_sheet(workbook, worksheet2, 'Hoja2');

                        // Agregar título de encabezado
                        const titleCellStyle = {
                            font: {
                                color: {
                                    rgb: '000000' // Color de texto negro
                                },
                                bold: true,
                                size: 14 // Tamaño de la fuente
                            },
                            alignment: {
                                horizontal: 'center' // Alineación centrada
                            },
                        };
                        const titleRow = XLSX.utils.json_to_sheet([{
                            A: fileName
                        }], {
                            skipHeader: true
                        });
                        XLSX.utils.sheet_add_json(titleRow, [{
                            A: null
                        }], {
                            skipHeader: true,
                            origin: 'A2'
                        }); // Agregar fila en A2
                        XLSX.utils.sheet_add_json(titleRow, [{
                            A: null
                        }], {
                            skipHeader: true,
                            origin: 'A3'
                        }); // Agregar fila en A3
                        XLSX.utils.book_append_sheet(workbook, titleRow, 'Título');

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
                    .catch(error => console.error('Error al obtener los datos de la segunda API:', error));
            })
            .catch(error => console.error('Error al obtener los datos de la primera API:', error));
    }
</script>




<script>
    function exportTo3Excel(apiUrl, titulo1, apiUrl2, titulo2, apiUrl3, titulo3, fileName) {
        // Hacer la solicitud AJAX a la primera API para obtener los datos
        fetch(`${apiUrl}`)
            .then(response => response.json())
            .then(data => {
                // Crear una hoja de cálculo
                const workbook = XLSX.utils.book_new();

                // Crear la hoja de cálculo con los datos de la primera API
                const worksheet1 = XLSX.utils.json_to_sheet(data.data, {
                    header: Object.keys(data.data[0])
                });
                XLSX.utils.book_append_sheet(workbook, worksheet1, titulo1);

                // Hacer la solicitud AJAX a la segunda API para obtener los datos
                fetch(`${apiUrl2}`)
                    .then(response2 => response2.json())
                    .then(data2 => {
                        // Crear la hoja de cálculo con los datos de la segunda API
                        const worksheet2 = XLSX.utils.json_to_sheet(data2.data, {
                            header: Object.keys(data2.data[0])
                        });
                        XLSX.utils.book_append_sheet(workbook, worksheet2, titulo2);

                        // Hacer la solicitud AJAX a la tercera API para obtener los datos
                        fetch(`${apiUrl3}`)
                            .then(response3 => response3.json())
                            .then(data3 => {
                                // Crear la hoja de cálculo con los datos de la tercera API
                                const worksheet3 = XLSX.utils.json_to_sheet(data3.data, {
                                    header: Object.keys(data3.data[0])
                                });
                                XLSX.utils.book_append_sheet(workbook, worksheet3, titulo3);

                                // Agregar título de encabezado
                                const titleCellStyle = {
                                    font: {
                                        color: {
                                            rgb: '000000' // Color de texto negro
                                        },
                                        bold: true,
                                        size: 14 // Tamaño de la fuente
                                    },
                                    alignment: {
                                        horizontal: 'center' // Alineación centrada
                                    },
                                };
                                const titleRow = XLSX.utils.json_to_sheet([{
                                    A: fileName
                                }], {
                                    skipHeader: true
                                });
                                XLSX.utils.sheet_add_json(titleRow, [{
                                    A: null
                                }], {
                                    skipHeader: true,
                                    origin: 'A2'
                                }); // Agregar fila en A2
                                XLSX.utils.sheet_add_json(titleRow, [{
                                    A: null
                                }], {
                                    skipHeader: true,
                                    origin: 'A3'
                                }); // Agregar fila en A3
                                XLSX.utils.book_append_sheet(workbook, titleRow, 'Título');

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
                            .catch(error => console.error('Error al obtener los datos de la tercera API:', error));
                    })
                    .catch(error => console.error('Error al obtener los datos de la segunda API:', error));
            })
            .catch(error => console.error('Error al obtener los datos de la primera API:', error));
    }
</script>





@endsection