@extends('layouts.app')





 
<style>
    <style>.small-box {
        text-align: center;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 10px;
        color: #fff;
    }

    .small-box h3 {
        font-size: 28px;
        margin-top: 0;
    }

    .small-box p {
        font-size: 14px;
    }

    /* Colores */
    .bg-planta {
        background-color: #ff6b6b;
        /* Rojo anaranjado */
    }

    .bg-jubilaciones {
        background-color: #72d572;
        /* Verde claro */
    }

    .bg-ausentismo {
        background-color: #f9cb42;
        /* Amarillo */
    }

    .bg-altas {
        background-color: #5499c7;
        /* Azul claro */
    }

    html,
    body,
    #containerb {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #div_generoxv {
        width: 50%;
        height: 50%;
        margin: 0;
        padding: 0;
    }

    #div_uor {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }


    .tarjeta-container {
        margin-top: 20px;
        /* Puedes ajustar el valor según sea necesario */

    }

    /* Agrega este estilo CSS a tu hoja de estilos */
    .borde-superior {
        border-top: 3px solid #3498db;
        /* Color celeste (#3498db) y grosor del borde */
    }

    .loader {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: block;
    margin:15px auto;
    position: relative;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
  }
  .loader::after,
  .loader::before {
    content: '';  
    box-sizing: border-box;
    position: absolute;
    left: 0;
    top: 0;
    /* background: #FF3D00;
    #008B8B */
    background: #008B8B;    
    width: 16px;
    height: 16px;
    transform: translate(-50%, 50%);
    border-radius: 50%;
  }
  .loader::before {
    left: auto;
    right: 0;
    background: #FFF;
    transform: translate(50%, 100%);
  }

@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}       


    
    #myTable tbody tr td {
        height: 30% !important;
        font-size: 80% !important;        
    }    

</style>

@section('content')

<section class="content container-fluid">

    <div class="row  tarjeta-container">


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" id="jubilados-card">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Hombres en condiciones de jubilarse</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>

                            <span   class="loader" style="display: none;"></span>

                        </div>
                        <div class="col-auto">

                            <i class="fas fa-male fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" id="jubiladas-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Mujeres en condiciones de jubilarse</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>

                            <span id="loader" class="loader" style="display: none;"></span>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
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
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total jubilados / bajas ultimo año</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1145</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 

<!-- HTML table structure -->
<table id="myTable" data-toggle="table" data-url="http://localhost:3000/jubilaciones_detalle/202309" data-pagination="true" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th data-field="CUIL">CUIL </th>
            <th data-field="NOMBREAPELLIDO">Nombre y Apellido </th> 
            <!-- Add more columns as needed -->
        </tr>
    </thead>
</table>

 



</section>

 



  <script>
     async function actualizarDatosJubilados() {
         try {
         // Mostrar el loader al iniciar la carga de datos
         document.getElementById('loader').style.display = 'block';
         const response = await fetch('http://localhost:3000/jubilaciones/202309');
             const data = await response.json();
             const cantidadJubilados = data.hombres;
             // Actualiza el contenido de la tarjeta con la nueva cantidad de jubilados
             const jubiladosCard = document.getElementById('jubilados-card');
             jubiladosCard.querySelector('.h5').textContent = cantidadJubilados;
             const cantidadJubiladas = data.mujeres;
             console.log(cantidadJubiladas);
             // Actualiza el contenido de la tarjeta con la nueva cantidad de jubilados
             const jubiladasCard = document.getElementById('jubiladas-card');            
             jubiladasCard.querySelector('.h5').textContent = cantidadJubiladas;    
        

             // Actualiza el contenido de la tarjeta de Tramites iniciados
             const iniciadosCard = document.getElementById('iniciados-card');            
             iniciadosCard.querySelector('.h5').textContent = data.iniciados ;                        
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


@endsection