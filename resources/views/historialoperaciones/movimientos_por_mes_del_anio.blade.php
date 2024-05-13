@extends('layouts.app')

@section('content')

<!-- Main content -->
<section class="content container-fluid">



    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $expedientes }}</h3>
                    <p>Expedientes {{ $hoyanio }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
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

        <div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
            <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
                <div class="panel-heading"><b>Expedientes por mes</b>
                </div>
                <div class="panel-body">
                    <canvas id="canvasdias" height="580" width="1200"></canvas>
                </div>
            </div>
        </div>



    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

    <script>
    // project://app\Http\Controllers\historialoperacionesController.php#259  public function graficar_dias()
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

            var ctx2 = document.getElementById("canvasdias").getContext('2d');
            var myChartMeses = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: Etiquetas2,
                    datasets: [{
                        label: ['mes'],
                        data: Cantidades2,
                        borderWidth: 2,

                        backgroundColor: '#33ECFF',
                        hoverBackgroundColor: '#3196C5',
                        borderColor: '#000000',


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


</section>



</body>


@endsection


</html>