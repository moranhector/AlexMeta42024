@extends('layouts.app')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



@section('content')


<section class="content container-fluid">



    <div class="col-xl-12 col-md-6 my-4">


        <!-- +-+-+-+-+-+ +-+-+-+-+-+-+-+-+ +-+-+-+-+-+ +-+-+ +-+-+-+-+-+-+
  |B|O|T|O|N| |A|P|E|R|T|U|R|A| |M|O|D|A|L| |D|E| |P|R|U|E|B|A|                          |
 +-+-+-+-+-+ +-+-+-+-+-+-+-+-+ +-+-+-+-+-+ +-+-+ +-+-+-+-+-+-+ -->
        <!-- <button type="button" data-toggle="modal" data-target="#exampleModal">
            Abrir Modal
        </button> -->
        <!-- +-+-+-+-+-+ +-+-+-+-+-+-+-+-+ +-+-+-+-+-+ +-+-+ +-+-+-+-+-+-+
  FIN |B|O|T|O|N| |A|P|E|R|T|U|R|A| |M|O|D|A|L| |D|E| |P|R|U|E|B|A|  FIN
 +-+-+-+-+-+ +-+-+-+-+-+-+-+-+ +-+-+-+-+-+ +-+-+ +-+-+-+-+-+-+ -->

        <div class="card border-left-primary shadow h-40 py-2">

            <div class="card-body">

                <div class="panel-heading">
                    <h2>Legajos de Empleados</h2>
                </div>

                <table id="table_personas" class="table display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Persona</th>
                            <th>DNI</th>
                            <th>T</th> 
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </div>



</section>


<!-- +--+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
 |V|E|N|T|A|N|A| |M|O|D|A|L| |D|E| |E|J|E|M|P|L|O|                         |
 +-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+ -->

 
  
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title">Información Personal</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                

                <div class="container" style="background: #eaf1f7">


                    <div class="tab-content" style="width: 100% ;padding: 5px">
                        <div class="tab-pane fade show active" id="tab1">

                            <div id="formulario" class="formulario">
                                <h2>Información de Persona</h2>
                                <form>
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" readonly>

                                    <label for="documento">Documento:</label>
                                    <input type="text" id="documento" readonly>

                                    <label for="domicilio">ID:</label>
                                    <input type="text" id="id_persona" readonly>

                                    <label for="cuil">CUIL:</label>
                                    <input type="text" id="cuil" readonly>

                                    <label for="cuil">TIPO:</label>
                                    <input type="text" id="tipo_empleado" readonly>


                                    <h2>Domicilio</h2>
                                

                                    <label for="domicilio">Domicilio:</label>
                                    <input type="text" id="domicilio" readonly>

                                    <label for="calle">Calle:</label>
                                    <input type="text" id="calle" readonly>

                                    <label for="numero">Número:</label>
                                    <input type="text" id="numero" readonly>

                                    <label for="lugar">Lugar:</label>
                                    <input type="text" id="lugar" readonly>

                                    <label for="cp">Código Postal:</label>
                                    <input type="text" id="cp" readonly>

                                    <h2>Caracter - Jurisdicción</h2>
                                    <h5>( Fuente: Signos ) </h5>
                           
                                    <label for="car">Carácter:</label>
                                    <input type="text" id="car" readonly>                                    

                                    <label for="jur">Jurisdicción:</label>
                                    <input type="text" id="jur" readonly>                                    

                                    <label for="uor">UOR:</label>
                                    <input type="text" id="uor" readonly>                                    

                                    


                                    <h2>Lugar de Trabajo</h2>
                                    <h5>( Fuente: Meta4 ) </h5>                                    
                           
                                    <label for="lugar_trabajo">Nombre:</label>
                                    <input type="text" id="lugar_trabajo" readonly>

                                    <h2>Situación Jubilatoria</h2>
                              
                                    <label for="situacion">En condiciones de jubilarse (S/N):</label>
                                    <input type="text" id="situacion" readonly>

                                    <label for="fechanacimiento">Fecha de Nacimiento:</label>
                                    <input type="text" id="fechanacimiento" readonly>

                                    <label for="fechaingreso">Fecha de Ingreso:</label>
                                    <input type="text" id="fechaingreso" readonly>
                             
                                    <h2>Haberes</h2>
                                    <h5>( Fuente: Signos ) </h5>                                    
                              
                                    <label for="sueldo">Sueldo Bruto:</label>
                                    <input type="text" id="sueldo" readonly>

                                    <label for="cant-liq">Cant. Liquidaciones:</label>
                                    <input type="text" id="cant-liq" readonly>

                                    <label for="horapromedio">Valor Hora Promedio:</label>
                                    <input type="text" id="horapromedio" readonly>

                                    <label for="rank-gobierno">Ranking Gobierno:</label>
                                    <input type="text" id="rank-gobierno" readonly>

                                    <label for="rank-uor">Ranking UOR:</label>
                                    <input type="text" id="rank-uor" readonly>                                    
                             


                                </form>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab2">



                            <div id="formulario2" class="formulario">

                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab3">

                            <div id="formulario3" class="formulario">
                                <h2>Domicilio</h2>
 
                            </div>

                        </div>

 
                        <div class="tab-pane fade" id="tab4">
                            <div id="formulario4" class="formulario">

                            </div>
                        </div>
                    </div>
                </div>






            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()" data-dismiss="modal">Cerrar</button>
                <!-- Puedes agregar más botones según tus necesidades -->
            </div>
        </div>
    </div>
</div>

<!-- +--+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
 |V|E|N|T|A|N|A| |M|O|D|A|L| |D|E| |E|J|E|M|P|L|O|                 FIN FIN
 +-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+ -->




<script src="js/variables_entorno.js"></script>


<!-- DATATABLES -->
<script src="https://code.jquery.com/jquery-3.7.1.js"> </script>
<!--GPT <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"> </script> -->
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
    // Inicialización del DataTable
    var dataTable = new DataTable('#table_personas', {
        language: {
            url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
        },
        searchDelay: 1000,
        ajax: SERVER_NODE + '/personas2',
        columns: [{
                data: 'SCO_GB_NAME'
            },
            {
                data: 'STD_SSN'
            },
            {
                data: 'TIPO_EMPLEADO'
            },            
            {
                data: 'STD_ID_PERSON',
                render: function(data) {
                    return '<button class="btn btn-primary export-button" data-std_id_person="' + data + '">' +
                        'Ver' +
                        '</button>';
                }
            }
        ]
    });

    // Función para abrir la ventana modal al hacer clic en el botón
    $('#table_personas').on('click', '.export-button', function() {
        // Obtener el valor del atributo data-std_id_person del botón
        var stdIdPerson = $(this).data('std_id_person');

        //const std_id_person = event.target.dataset.std_id_person;
        console.log('std_id_person', stdIdPerson);        

        // Aquí puedes utilizar stdIdPerson para cargar la información específica de la persona en la ventana modal
        mostrarFormulario( stdIdPerson );
        // Abrir la ventana modal correspondiente (reemplaza #exampleModal con el ID de tu ventana modal)
        
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
                    const jubilacion = data.data.jubilacion[0];

                    console.log(' PERSONA ', data.data.persona[0]);
                    console.log(' DOMICILIO ', domicilio);
                    // Llena el formulario con los datos recibidos
                    document.getElementById('nombre').value = persona.SCO_GB_NAME;
                    document.getElementById('documento').value = persona.STD_SSN;
                    document.getElementById('id_persona').value = persona.STD_ID_PERSON;
                    document.getElementById('cuil').value = persona.CUIL;
                    document.getElementById('tipo_empleado').value = persona.TIPO_EMPLEADO;
                    // Otros campos
                    // Muestra el formulario
                    document.getElementById('formulario').style.display = 'block';
                    //DATOS DE DOMICILIO
                    document.getElementById('domicilio').value = domicilio.DOMICILIO;
                    document.getElementById('calle').value = domicilio.DOMI_CALLE;
                    document.getElementById('numero').value = domicilio.DOMI_NUMERO;
                    document.getElementById('lugar').value = domicilio.DOMI_LUGAR;
                    document.getElementById('cp').value = domicilio.DOMI_CP;
                    // SITUACION JUBILATORIA

                    //var cadena = jubilacion.AJUB;

                    // Transformar a "SI" o "NO"

                    if (persona.TIPO_EMPLEADO === 'P') {
                        var ajubilarse = jubilacion.AJUB === "S" ? "SI" : "NO";
                        document.getElementById('situacion').value = ajubilarse;
                    } else {
                        var ajubilarse = "NO (Contrato)";
                        document.getElementById('situacion').value = ajubilarse;
                    }


                    if (persona.TIPO_EMPLEADO === 'P') {
                        var fechaCadena = jubilacion.FECHAINGRESO;

                        // Dividir la cadena en sus componentes (día, mes y año)
                        var partes = fechaCadena.split('-');
                        var año = partes[0];
                        var mes = partes[1];
                        var dia = partes[2].split('T')[0];

                        // Formatear la fecha en el formato deseado
                        var fechaFormateada = dia + '/' + mes + '/' + año;

                        // Mostrar la fecha formateada
                        console.log(fechaFormateada); // Output: "18/10/2000"                 

                        document.getElementById('fechaingreso').value = fechaFormateada;


                        var fechaCadena = jubilacion.FECHANACIMIENTO;

                        // Dividir la cadena en sus componentes (día, mes y año)
                        var partes = fechaCadena.split('-');
                        var año = partes[0];
                        var mes = partes[1];
                        var dia = partes[2].split('T')[0];

                        // Formatear la fecha en el formato deseado
                        var fechaFormateada = dia + '/' + mes + '/' + año;

                        // Mostrar la fecha formateada
                        console.log(fechaFormateada); // Output: "18/10/2000"                    

                        document.getElementById('fechanacimiento').value = fechaFormateada;
                    } else {
 
                    }




                    // $('#exampleModal').modal('show');

                    // Llamar a la función para mostrar la ventana modal
                    showModal();                    

                } else {
                    console.error('No se encontraron datos para el ID de persona:', stdIdPerson);
                }


                

            })
            .catch(error => console.error('Error al obtener datos de la persona:', error));
    }
</script>

<script>
    // Función para mostrar la ventana modal
    function showModal() {
    // Restablecer el estilo de visualización de la ventana modal a "block"
    document.getElementById("exampleModal").style.display = "block";

    // Eliminar cualquier fondo gris oscuro restante
    var modalBackdrop = document.querySelector('.modal-backdrop');
    if (modalBackdrop) {
        modalBackdrop.parentNode.removeChild(modalBackdrop);
    }

    // Llamar a la función modal de Bootstrap para mostrar la ventana modal
    $('#exampleModal').modal('show');
    }



</script>

<!-- <script>
    // function cerrarFormulario() {
    //     document.getElementById('formulario').style.display = 'none';
    // }
</script>

<script>
// Obtener el elemento de cierre
var closeBtn = document.querySelector(".close");
// Obtener la ventana modal
var modal = document.getElementById("exampleModal");

// Agregar un evento de clic al botón de cierre
closeBtn.addEventListener("click", function() {
  modal.style.display = "none"; // Ocultar la ventana modal
  //document.body.style.overflow = ""; // Restablecer el desplazamiento del cuerpo  
  //document.querySelector('.modal-backdrop').remove(); // Eliminar el fondo gris oscuro  
});
</script> -->

<script>
// Obtener el botón de cierre y la ventana modal
var closeBtn = document.querySelector(".close");
var modal = document.getElementById("exampleModal");

// Función para cerrar la ventana modal y eliminar el fondo gris oscuro
function closeModal() {
  modal.style.display = "none"; // Ocultar la ventana modal
  document.body.classList.remove("modal-open"); // Eliminar la clase que bloquea el desplazamiento del cuerpo
  var modalBackdrop = document.querySelector('.modal-backdrop');
  if (modalBackdrop) {
    modalBackdrop.parentNode.removeChild(modalBackdrop); // Eliminar el fondo gris oscuro si existe
  }
}

// Agregar un evento de clic al botón de cierre para llamar a la función closeModal
closeBtn.addEventListener("click", closeModal);

// Agregar un evento de clic al fondo gris oscuro para cerrar la ventana modal
modal.addEventListener("click", function(event) {
  if (event.target === modal) {
    closeModal(); // Cerrar la ventana modal solo si se hace clic en el fondo gris oscuro
  }
});
</script>




@endsection