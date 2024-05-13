<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel designer">
    <meta name="author" content="bestmomo">

    <title>Laravel Designer</title>

    {!! Html::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') !!}
    {!!
    Html::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800')
    !!}
    {!!
    Html::style('http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic')
    !!}
    {!! Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') !!}
    {!! Html::style('css/main.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">




    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">



            <ul class="nav navbar-nav navbar-left">


                <li>

                    <img src="{{asset('images/escudoblanco.jpg')}}">
                </li>
                <li>
                    <a class="navbar-brand" href="#page-top" style="margin-left: 50px;font-size: 30px;margin-top: 10px">Contaduría General de la Provincia</a>
                </li>
            </ul>



            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">


                    <li>

                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="font-size: 22px;margin-top: 10px">Acceder</a>
                    </li>
                    <li>
                        <a href="#contact" style="font-size: 22px;margin-top: 10px" >Registrarme</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header></header>

    <section id="about" class="bg-black">
        <div class="container text-center" style="margin-bottom :  300px; margin-top : 100px">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    
                    <hr class="light">
                    <div class="col-lg-12 text-center">
                        <h1 style="font-size: 70px;margin-top:100px">ALEX</h1>
                        <br>
                    </div>
                    <hr class="light">
                    <p  style="font-size: 20px;" >Análisis de uso de Sistema de Expedientes Electrónicos</p>
                    <p  style="font-size: 20px;" >Indicadores de productividad y calidad de los procesos</p>
                    <hr class="light">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <!-- <i class="fa fa-4x fa-rocket text-primary"></i>
                        <h3>Fast</h3>
                        <p class="text-muted">A few seconds</p> -->
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <!-- <i class="fa fa-4x fa-hand-pointer-o text-primary"></i>
                        <h3>Easy</h3>
                        <p class="text-muted">Only some clics</p> -->
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <!-- <i class="fa fa-4x fa-calendar-check-o text-primary"></i>
                        <h3>Up to date</h3>
                        <p class="text-muted">Get the last versions</p> -->
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <!-- <i class="fa fa-4x fa-gears text-primary"></i>
                        <h3>Scalable</h3>
                        <p class="text-muted">Make it evolve</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary" id="features">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12">
                    <!-- <h3>Create your own customized Laravel with some clics !</h3> -->
                    <br>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-list"></i>
                        <h3>Estadísticas</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-bar-chart"></i>
                        <h3>Gráficos</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-stack-overflow"></i>
                        <h3>Indicadores</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">

                        <i class="fa fa-4x fa-file-excel-o"></i>
                        <h3>Reportes</h3>
                    </div>
                </div>


            </div>
        </div>
    </section>






    <!-- Modal -->
    <div class="modal fade" id="contactForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title" id="contactLabel">Contact me !</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'contact', 'id' => 'formcontact', 'method' => 'post', 'class' =>
                    'form-horizontal']) !!}
                    <div class="form-group col-lg-12">
                        <label class="control-label">E-Mail</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="control-label">Message</label>
                        <textarea rows="4" class="form-control" name="message" id="message"></textarea>
                        <small class="help-block"></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {!! Html::script('https://code.jquery.com/jquery-2.1.4.min.js') !!}
    {!! Html::script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js') !!}
    {!! Html::script('js/main.js') !!}

</body>

</html>