@extends('layouts.app')



@section('content')

<!-- Main content -->
<section class="content container-fluid">

    <div class="card">

        <h1 class="display-5 fw-bold" style="margin: 20px">Contaduría General de la Provincia</h1>
    </div>

    <div class="card">



        <!-- <div id="demo" style="width: 550px; height: 350px; position: relative;"></div>
  </div> -->


        <!-- <div class="row"> -->


        <!-- </div> -->

        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $expedientes2022 }}</h3>
                        <p>Expedientes 2022</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $expedientes2021 }}<sup style="font-size: 20px"></sup></h3>
                        <p>Expedientes 2021</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$expedientesRecibidosAyer->count() }}<sup style="font-size: 20px"></sup></h3>
                        <p>Expedientes recibidos ayer</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$expedientesEntregadosAyer->count() }}<sup style="font-size: 20px"></sup></h3>
                        <p>Expedientes salieron ayer</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="card card-widget widget-user" style=" padding: 20px;  margin: 20px; ">

            <div class="card-header">
                <h1 class="card-title"><b>Expedientes por año</b></h1>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="col-md-4">
                    <div class="panel panel-default"
                        style="box-shadow: 6px 20px 10px black; margin-top: 5px; margin-bottom: 5px padding: 20px; ">

                        <div class="panel-body">
                            <canvas id="canvas" height="280" width="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div></div>


        </div>
        <div class="card card-widget widget-user" style=" padding: 20px;  margin: 20px; ">

            <div class="card-header">
                <h1 class="card-title"><b>Expedientes por mes</b></h1>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">


                <div class="col-md-4">
                    <div class="panel panel-default"
                        style="box-shadow: 6px 20px 10px black; margin-top: 5px; margin-bottom: 5px  padding: 20px; ">

                        <div class="panel-body">
                            <canvas id="canvasmeses" height="280" width="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="panel panel-default"
                style="box-shadow: 6px 20px 10px black; margin-top: 15px; margin-bottom: 5px ">
                <div class="panel-heading" padding="10px">
                </div>
                <div class="panel-body"><b>Sectores de los que provienen más expedientes</b>
                    <div id="demo" style="width: 550px; height: 350px; position: relative;"></div>
                </div>
            </div>
        </div>

    </div>



    <div class="row">


        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Entradas y Salidas por mes del año {{ $hoyanio }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Mes</th>
                                <th> </th>
                                <th>Entrantes</th>
                                <th>Salientes</th>
                                <th>Diferencia</th>
                                <th>Totales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entradas as $entrada)


                            <tr>

                                <td><span class="badge badge-success">{{ $entrada->MES }}</span></td>


                                <td STYLE="text-align: right;">
                                    <a href="{{ route('expedientes_dia', [ $fecha_informe  ,  $entrada->MES ] ) }}"
                                        title="Clic para expandir por día" class="badge badge-success">
                                        <i class="far fa-eye"></i>&nbsp{{ strtoupper($months[$entrada->MES] )     }}
                                    </a>
                                </td>




                                <!-- <td><div class="sparkbar" data-color="#00a65a" data-height="20" STYLE="text-align: right;" >{{ $entrada->ENTRANTES }}  </div></td> -->
                                <td STYLE="text-align: right;">
                                    <a href="{{ route('expedientes_usuario', [ $fecha_informe ,  $entrada->MES ]) }}"
                                        title="Clic para expandir por usuarios" class='btn btn-default btn-xs'>
                                        <i class="far fa-eye"></i>&nbsp{{ $entrada->ENTRANTES }}
                                    </a>
                                </td>


                                </a>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"
                                        STYLE="text-align: right;">{{ $entrada->SALIENTES }} </div>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"
                                        STYLE="text-align: right;">{{ $entrada->DIFERENCIA }} </div>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"
                                        STYLE="text-align: right;">{{ $entrada->TOTALES }} </div>
                                </td>


                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Excel</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">PDF</a>
            </div>

        </div>





    </div>

 



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"
        charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>


    <script>
    var url = "{{url('graficos/cgp_expedienes_anio')}}";
    var Etiquetas = new Array();
    var Cantidades = new Array();




    $(document).ready(function() {
        $.get(url, function(response) {
            response.forEach(function(data) {
                Etiquetas.push(data.anios);
                Cantidades.push(data.cantidad);

                //console.log( "ETIQUETAS" , data.anios  );

            });




            console.log("RESPONSE", response);

            var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Etiquetas,
                    datasets: [{
                        label: ['anios'],
                        data: Cantidades,
                        borderWidth: 2,

                        backgroundColor: 'rgb(175, 235, 235)',
                        hoverBackgroundColor: '#00f2f2',
                        borderColor: 'rgb(175, 235, 235)',


                    }]

                },

                options: {
                    title: {
                        display: true,
                        text: 'Expedientes por Año'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }


                }
            });
        });
    });
    </script>


    <script>
    var url2 = "{{url('graficos/meses')}}";
    var Etiquetas2 = new Array();
    var Cantidades2 = new Array();




    $(document).ready(function() {
        $.get(url2, function(response) {
            response.forEach(function(data) {
                Etiquetas2.push(data.mes);
                Cantidades2.push(data.cantidad);

                //console.log( "ETIQUETAS" , data.anios  );

            });






            var ctx2 = document.getElementById("canvasmeses").getContext('2d');
            var myChartMeses = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: Etiquetas2,
                    datasets: [{
                        label: ['Meses'],
                        data: Cantidades2,

                        borderWidth: 2,

                        backgroundColor: 'rgb(175, 235, 235)',
                        hoverBackgroundColor: 'rgb(2, 235, 235)',
                        borderColor: 'rgb(175, 235, 235)',


                        fill: false,
                        borderColor: "rgb(75, 192, 192)",
                        lineTension: 0.5,




                    }]

                },

                options: {
                    title: {
                        display: true,
                        text: 'Expedientes por Mes'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }


                }
            });
        });
    });
    </script>

    <script>
    // var words = [
    //   {text: "Lorem", weight: 13},
    //   {text: "Ipsum", weight: 10.5},
    //   {text: "Dolor", weight: 9.4},
    //   {text: "Sit", weight: 8},
    //   {text: "Amet", weight: 6.2},
    //   {text: "Consectetur", weight: 5},
    //   {text: "Adipiscing", weight: 5},
    //   /* ... */
    // ];


    // $('#demo-simple').jQCloud(words);


    // var words = [
    //     { text: "Lorem", weight: 13, color: "#FF0000" },
    //     { text: "Ipsum", weight: 10.5, color: "violet" },
    //     { text: "Dolor", weight: 9.4, color: "#0000FF" },
    //     { text: "Sit", weight: 8, color: "orange" },
    //     { text: "Amet", weight: 6.2, color: "#26FC32" },
    //     { text: "Consectetur", weight: 5, color: "#006600" },
    //     { text: "Adipiscing", weight: 5, color: "green" }
    // ];


    var words = [{
            text: "DADM#MSEG",
            weight: 4417,
            color: "#FF0000"
        },
        {
            text: "IMCYT",
            weight: 3617,
            color: "violet"
        },
        {
            text: "SDAC#MSDSYD",
            weight: 3452,
            color: "#0000FF"
        },
        {
            text: "DATPD#MSDSYD",
            weight: 3109,
            color: "orange"
        },
        {
            text: "HABI_SSCSPP",
            weight: 3025,
            color: "#26FC32"
        },
        {
            text: "DGSERP#MSEG",
            weight: 2686,
            color: "#006600"
        },
        {
            text: "FIDES#MSDSYD",
            weight: 2621,
            color: "green"
        }
    ];

    // DADM#MSEG	4417
    // MCYT	3617
    // SDAC#MSDSYD	3452
    // DATPD#MSDSYD	3109
    // HABI_SSCSPP	3025
    // DGSERP#MSEG	2686
    // FIDES#MSDSYD	2621
    // DAAM#MSDSYD	1486
    // DGADM#MHYF	1306
    // SCP_DGADM	1137


    $("#demo").jQCloud(words);

    setTimeout(function() {
        var obj = $("#demo").data("jqcloud");
        var data = obj.word_array;
        for (var i in data) {
            $("#" + data[i]["attr"]["id"]).css("color", data[i]["color"]);
        }
    }, 100);
    </script>


</section>







</body>


@endsection












</html>