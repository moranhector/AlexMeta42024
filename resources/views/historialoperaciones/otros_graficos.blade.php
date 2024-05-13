@extends('layouts.app')

@section('content')

<!-- Main content -->
<section class="content container-fluid">












    <!-- <div class="row"> -->


    <!-- </div> -->

    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $expedientes }}</h3>
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
                    <h3>{{ $expedientes2020 }}<sup style="font-size: 20px"></sup></h3>
                    <p>Expedientes 2020</p>
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
                    <h3>{{ $expedientes2019 }}<sup style="font-size: 20px"></sup></h3>
                    <p>Expedientes 2019</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>



    <div class="row">


        <div class="col-md-4">
            <div class="panel panel-default"
                style="box-shadow: 6px 20px 10px black; margin-top: 5px; margin-bottom: 5px ">
                <div class="panel-heading"><b>Expedientes</b>
                </div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="400"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default"
                style="box-shadow: 6px 20px 10px black; margin-top: 5px; margin-bottom: 5px ">
                <div class="panel-heading"><b>Expedientes</b>
                </div>
                <div class="panel-body">
                    <canvas id="canvasmeses" height="280" width="400"></canvas>
                </div>
            </div>
        </div>






    </div>

    <!--     

    <div class="row">


        <div class="col-md-6">


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Area Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class="">
                                    <canvas id="canvas" height="280" width="400"></canvas>
                                </div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="areaChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 319px;"
                            width="319" height="250" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>

            </div>




            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Area Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class="">
                                    <canvas id="canvasmeses" height="280" width="400"></canvas>
                                </div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="areaChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 319px;"
                            width="319" height="250" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>

            </div>







        </div> -->

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"
        charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>


    <script>
    var url = "{{url('graficos/ejemplo')}}";
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
                        hoverBackgroundColor: 'rgb(255, 235, 235)',
                        borderColor: 'rgb(255, 99, 132)',


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
                type: 'bar',
                data: {
                    labels: Etiquetas2,
                    datasets: [{
                        label: ['Meses'],
                        data: Cantidades2,
                        borderWidth: 2,

                        backgroundColor: 'rgb(175, 235, 235)',
                        hoverBackgroundColor: 'rgb(255, 235, 235)',
                        borderColor: 'rgb(255, 99, 132)',


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


__ _               
                  <!-- / _(_)              
   __ _ _ __ __ _| |_ _  ___ ___  ___ 
  / _` | '__/ _` |  _| |/ __/ _ \/ __|
 | (_| | | | (_| | | | | (_| (_) \__ \
  \__, |_|  \__,_|_| |_|\___\___/|___/
   __/ |                              
  |___/                               
 -->


$(function(){'use strict'
var salesChartCanvas=$('#salesChart').get(0).getContext('2d')

var salesChartData={labels:['January','February','March','April','May','June','July'],
    datasets:[{label:'Digital Goods',backgroundColor:'rgba(60,141,188,0.9)',
        borderColor:'rgba(60,141,188,0.8)',pointRadius:false,pointColor:'#3b8bba',
        pointStrokeColor:'rgba(60,141,188,1)',pointHighlightFill:'#fff',
        pointHighlightStroke:'rgba(60,141,188,1)',data:[28,48,40,19,86,27,90]},
        {label:'Electronics',backgroundColor:'rgba(210, 214, 222, 1)',
            borderColor:'rgba(210, 214, 222, 1)',pointRadius:false,
            pointColor:'rgba(210, 214, 222, 1)',pointStrokeColor:'#c1c7d1',pointHighlightFill:'#fff',
            pointHighlightStroke:'rgba(220,220,220,1)',data:[65,59,80,81,56,55,40]}]}

var salesChartOptions={maintainAspectRatio:false,
    responsive:true,legend:{display:false},
    scales:{xAxes:[{gridLines:{display:false}}],
    yAxes:[{gridLines:{display:false}}]}}

var salesChart=new Chart(salesChartCanvas,{type:'line',data:salesChartData,options:salesChartOptions})

var pieChartCanvas=$('#pieChart').get(0).getContext('2d')

var pieData={labels:['Chrome','IE','FireFox','Safari','Opera','Navigator'],
    datasets:[{data:[700,500,400,600,300,100],
    backgroundColor:['#f56954','#00a65a','#f39c12','#00c0ef','#3c8dbc','#d2d6de']}]}

var pieOptions={legend:{display:false}}

var pieChart=new Chart(pieChartCanvas,{type:'doughnut',data:pieData,options:pieOptions})
$('#world-map-markers').mapael({map:{name:'usa_states',zoom:{enabled:true,maxLevel:10}}})})





</section>







</body>


@endsection












</html>