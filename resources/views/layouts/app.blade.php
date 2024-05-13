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
<body class="hold-transition sidebar-mini layout-fixed">
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


@stack('third_party_scripts')

@stack('page_scripts')
</body>
</html>
