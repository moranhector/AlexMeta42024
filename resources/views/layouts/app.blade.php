<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


<!--     
 ██████╗███████╗███████╗    ███████╗███████╗████████╗██╗██╗      ██████╗ ███████╗
██╔════╝██╔════╝██╔════╝    ██╔════╝██╔════╝╚══██╔══╝██║██║     ██╔═══██╗██╔════╝
██║     ███████╗███████╗    █████╗  ███████╗   ██║   ██║██║     ██║   ██║███████╗
██║     ╚════██║╚════██║    ██╔══╝  ╚════██║   ██║   ██║██║     ██║   ██║╚════██║
╚██████╗███████║███████║    ███████╗███████║   ██║   ██║███████╗╚██████╔╝███████║
 ╚═════╝╚══════╝╚══════╝    ╚══════╝╚══════╝   ╚═╝   ╚═╝╚══════╝ ╚═════╝ ╚══════╝
 -->
                                                                                 
    <link rel="stylesheet" href="{{ asset('css/alex_styles.css') }}">



 
 

    <link rel="stylesheet" href="http://mistic100.github.io/jQCloud/dist/jqcloud2/dist/jqcloud.min.css">

   

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.css"
          integrity="sha512-EzrsULyNzUc4xnMaqTrB4EpGvudqpetxG/WNjCpG6ZyyAGxeB6OBF9o246+mwx3l/9Cn838iLIcrxpPHTiygAA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"
          integrity="sha512-mxrUXSjrxl8vm5GwafxcqTrEwO1/oBNU25l20GODsysHReZo4uhVISzAKzaABH6/tTfAxZrY2FprmeAP5UZY8A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
          integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
          crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
          integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
          crossorigin="anonymous"/>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous"/>

<!-- leaflet maps -->

          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

<!-- leaflet maps -->

<!--GPT <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css"> -->


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" crossorigin="anonymous"/> -->


          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   
          
          
          <!-- <script src="{{asset('/js/jqcloud.min.js')}}"></script> -->
          <script src="http://mistic100.github.io/jQCloud/dist/jqcloud2/dist/jqcloud.js"></script>

          <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
          <script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-bundle.min.js"></script>




    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<!-- <body class="hold-transition sidebar-mini layout-fixed dark-mode""> -->
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper" style="min-height: 1700px;">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                 <!-- SECCION DE LOGO -->
<!-- 
                    @ if( $sexo == 'F') -->
    
                   
                    <img src="{{asset('images/usuario_mujer.jpg')}}"  class="user-image elevation-4" alt="User Image">
                    <!-- @ endif
                    @ if( $sexo == 'M')
                 
                    <img src="{{asset('images/usuario_hombre.jpg')}}"  class="user-image elevation-4" alt="User Image">
                    @ endif -->


                 

                     
                 

                    @if(auth()->check())
                        <!-- El usuario está autenticado, puedes acceder a sus propiedades -->
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>                        
                    @else
                        <!-- El usuario no está autenticado, maneja este caso según tus necesidades -->
                        <!-- El usuario no está autenticado, redirigir a la página de inicio de sesión -->
                        <script>window.location = "{{ route('login') }}";</script>


                    @endif                    


                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- IMAGEN DEL USUARIO -->
                    <li class="user-header">


                    
                    <!-- @ if( $sexo == 'F') -->
 
                    <img src="{{asset('images/usuario_mujer.jpg')}}" class="elevation-4" alt="User Image"> <p>
                    <!-- @ endif
                    @ if( $sexo == 'M')
                    <img src="{{asset('images/usuario_hombre.jpg')}}" class="elevation-4" alt="User Image"> <p>
                    @ endif
                  -->

                  @if(auth()->check())
                        <!-- El usuario está autenticado, puedes acceder a sus propiedades -->
                        <p>
                            {{ Auth::user()->name }}
                            <small>Registrado en: {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>                 
                    @else
                        <!-- El usuario no está autenticado, maneja este caso según tus necesidades -->
                        <!-- El usuario no está autenticado, redirigir a la página de inicio de sesión -->
                        <script>window.location = "{{ route('login') }}";</script>


                    @endif      



                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <!-- <a href="#" class="btn btn-default btn-flat">Perfil</a> -->
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <!-- <footer class="main-footer">
        <div class="float-right d-none d-sm-block">

            <b>Version</b> 3.1.0
        </div>
        <strong>DIC&copy; 2023 <a href="https://www.mendoza.gov.ar/contaduria">Gobierno de Mendoza</a>.</strong>
        
    </footer> -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

        <!-- OJO NO REMOVER - SIRVE PARA DROPDOWN DE LOGOUT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script> 



<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"
        integrity="sha512-AJUWwfMxFuQLv1iPZOTZX0N/jTCIrLxyZjTRKQostNU71MzZTEPHjajSK20Kj1TwJELpP7gl+ShXw5brpnKwEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--GPT <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
        integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="
        crossorigin="anonymous"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.3/bootstrapSwitch.min.js"
        integrity="sha512-DAc/LqVY2liDbikmJwUS1MSE3pIH0DFprKHZKPcJC7e3TtAOzT55gEMTleegwyuIWgCfOPOM8eLbbvFaG9F/cA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>  -->

 

        <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-treemap.min.js"></script>        

<!--GPT <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8">
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/treemap.js"></script>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <script src="js/variables_entorno.js"></script>

    <script>
    // Evento al hacer clic en el botón de exportar
    $('#export-button-alcanzan-edad').on('click', function() {
        var dateRange = $('.daterangepicker-field').data('daterangepicker');

        var startDate = dateRange.startDate.format('DD-MM-YYYY');
        console.log(startDate);
        var endDate = dateRange.endDate.format('DD-MM-YYYY');


        var apiUrl = SERVER_NODE + '/alcanzan_edad_fechas/' + startDate + '/' + endDate;

        var fileName = 'Personas_que_alcanzan_edad_jubilatoria' + startDate + '_' + endDate + '.xlsx';
        console.log(apiUrl);
        exportToExcel(apiUrl, fileName);
    });
</script>


<script>


$('.daterangepicker-field').daterangepicker({
    "showDropdowns": true,
    ranges: {
        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Enero': [moment().month(0).startOf('month'), moment().month(0).endOf('month')],
                    'Febrero': [moment().month(1).startOf('month'), moment().month(1).endOf('month')],
                    'Marzo': [moment().month(2).startOf('month'), moment().month(2).endOf('month')],
                    'Abril': [moment().month(3).startOf('month'), moment().month(3).endOf('month')],
                    'Mayo': [moment().month(4).startOf('month'), moment().month(4).endOf('month')],
                    'Junio': [moment().month(5).startOf('month'), moment().month(5).endOf('month')],
                    'Julio': [moment().month(6).startOf('month'), moment().month(6).endOf('month')],
                    'Agosto': [moment().month(7).startOf('month'), moment().month(7).endOf('month')],
                    'Septiembre': [moment().month(8).startOf('month'), moment().month(8).endOf('month')],
                    'Octubre': [moment().month(9).startOf('month'), moment().month(9).endOf('month')],
                    'Noviembre': [moment().month(10).startOf('month'), moment().month(10).endOf('month')],
                    'Diciembre': [moment().month(11).startOf('month'), moment().month(11).endOf('month')]        
    },
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Personalizar",
        "weekLabel": "W",
        "daysOfWeek": [
            "Dom",
            "Lu",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    "alwaysShowCalendars": true,
    "startDate": moment(),
    "endDate": moment()
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
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




@stack('third_party_scripts')

@stack('page_scripts')
</body>
</html>
