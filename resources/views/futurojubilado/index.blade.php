@extends('layouts.app')
<!-- Bootstrap CSS -->



<style>
    /* En tu archivo de estilos CSS */
    th {
        color: #ffffff;
        /* Cambia el color del texto de todos los <th> a blanco */
    }

    /* En tu archivo de estilos CSS */
    thead {
        background-color: #007bff;
        /* Cambia el color de fondo de todos los <thead> */
    }


    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        background-color: #f9f9f9;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card p {
        margin: 0;
        font-size: 1em;
    }

    .card .number {
        font-size: 2em;
        font-weight: bold;
        color: #333;
    }

    .table-row-highlight {
        background-color: #ffffff;

    }

    .table-row-normal {
        background-color: #76d7c4;
        /* verde */

    }
</style>

@section('content')



<div class="container" style="margin-left: 0px;">
    @if (session()->has('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
    @endif

    <h1>Futuros Jubilados</h1>





    <!-- Botón para actualizar los futuros jubilados desde la API -->
    <a href="{{ url('/futurosjubilados/create_from_json') }}" class="btn btn-success mb-3">
        Actualizar Futuros Jubilados
    </a>





    <form method="GET" action="{{ route('futurojubilado.index') }}">


        <div class="row">


            <div class="col-md-3 form-group">
                <label for="etiqueta">Selecciona una Jurisdicción:</label>
                <select id="etiqueta" name="etiqueta" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    @foreach ($etiquetas as $etiqueta)
                    <option value="{{ $etiqueta->etiqueta }}" {{ request('etiqueta') == $etiqueta->etiqueta ? 'selected' : '' }}>
                        {{ $etiqueta->etiqueta }}
                    </option>
                    @endforeach
                </select>
            </div>





            <!-- primer formulario -->


            <div class="col-md-3 form-group">
                <label for="unidad">Unidades Organizativas:</label>
                <select id="unidad" name="unidad" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->unidad}}" {{ request('unidad') == $unidad->unidad ? 'selected' : '' }}>
                        {{ $unidad->unidad }}
                    </option>
                    @endforeach
                </select>
            </div>










        </div>


        <!-- SEGUNDA FILA -->

        <div class="row">

        <div class="col-md-3 form-group">
                <label for="estado">Selecciona un estado de trámite:</label>
                <select id="estado" name="estado" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos los estados</option>
                    <option value="STI">Sin trámites iniciados</option>
                    @foreach ($estados as $estado)
                    <option value="{{ $estado->last_cod_jub }}" {{ request('estado') == $estado->last_cod_jub ? 'selected' : '' }}>
                        {{ $estado->last_cod_jub }} {{ $estado->last_cod_jub_desc }}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-3 form-group">
                <label for="regimen">Selecciona un régimen:</label>
                <select id="regimen" name="regimen" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos los regímenes</option>
                    @foreach ($regimenes as $regimen)


                    <option value="{{ $regimen->regimen }}" {{ request('regimen') == $regimen->regimen ? 'selected' : '' }}>
                        {{ $regimen->regimen }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="genero">Selecciona un género:</label>
                <select id="genero" name="genero" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    @foreach ($generos as $genero)
                    <option value="{{ $genero->genero }}" {{ request('genero') == $genero->genero ? 'selected' : '' }}>
                        {{ $genero->genero }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label for="comment">Filtro por observaciones:</label>
                <select id="comment" name="comment" class="form-control" onchange="this.form.submit()">
                    <option value="" {{ request('comment') === '' ? 'selected' : '' }}>Todos</option>
                    <option value="con" {{ request('comment') === 'con' ? 'selected' : '' }}>Con observaciones</option>
                    <option value="sin" {{ request('comment') === 'sin' ? 'selected' : '' }}>Sin observaciones</option>
                </select>
            </div>

        </div>






        <!-- FIN TERCERA FILA -->



        <div class="row">

            <div class="col-md-3 form-group">

                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Buscar por nombre o CUIL">
            </div>




            <div class="col-md-7">
                <!-- Botón para buscar -->
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
            <div class="col-md-3 text-right">


 

            </div>

            <div class="col-md-2 text-right">
                <!-- Botón para exportar los datos a Excel -->
                <button type="submit" name="export_excel" value="1" class="btn btn-success">Exportar a Excel</button>
            </div>
        </div>


        <!-- primer formulario -->
        <div class="row align-items-end">
            <div class="col-md-4 form-group">
                <label for="usuario">Usuario de Seguimiento:</label>
                <select id="usuario" name="usuario" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos los usuarios</option>
                    @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->usuario }}" {{ request('usuario') == $usuario->usuario ? 'selected' : '' }}>
                        {{ $usuario->usuario }}
                    </option>
                    @endforeach
                </select>
            </div>

        </div>






    </form>



    @if(request()->has('usuario'))



    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-info" onclick="openSeguimientoModal()">
        Abrir Seguimiento
    </button>



    @endif










    <div id="mensaje-error" style="color: red;"></div>



    <!-- Espacio para mostrar el mensaje de error si no hay usuario en la URL -->
    <div id="mensaje-error" style="color: red;"></div>






    <!-- Personas que cumplen edad jubilatoria en rango de fechas -->

    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="panel-heading">
                <h5>Personas que cumplen edad jubilatoria en rango de fechas</h5>


            </div>
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> </div>



            </div>

        </div>
    </div>
    <input type="text" class="daterangepicker-field">
    <button id="export-button-alcanzan-edad">Descargar Informe</button>
    <!-- Javascript en layouts.app
    project://resources\views\layouts\app.blade.php#268 
    -->

    <!-- Personas que cumplen edad jubilatoria en rango de fechas -->










    <div class="card">
        <p>Total de futuros jubilados: <span class="number">{{ $totalJubilados }}</span></p>
    </div>

    <!-- Tabla -->


    <!-- Tabla    project://resources\views\futurojubilado\table_principal.blade.php  -->
    @include('futurojubilado.table_principal')
    <!-- Tabla    project://resources\views\futurojubilado\table_principal.blade.php  -->


    <div class="card mt-20">
        <p>Total de futuros jubilados: <span class="number">{{ $totalJubilados }}</span></p>
    </div>

    <div class="mt-20">
        <p>Alex Futuros Jubilados - DIC 2024</p>
    </div>

    <!-- Modal   project://resources\views\futurojubilado\modal.blade.php  -->
    @include('futurojubilado.modal')
    <!-- Modal   -->




</div>

<!-- Modal -->
<div class="modal fade" id="seguimientoModal" tabindex="-1" role="dialog" aria-labelledby="seguimientoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seguimientoModalLabel">Seguimiento de Usuario: <span id="modalUsuario"></span></h5>
                <button type="button" class="close" data-dismiss="modal" style="display:none;" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="seguimiento-form" action="{{ route('personas.guardarSeguimiento') }}" method="POST">
                    @csrf
                    <input type="hidden" name="m4user" id="modalM4User">

                    <div class="form-group">
                        <strong>Observaciones:</strong>
                        <textarea class="form-control" style="height:400px" name="observaciones" placeholder="Observaciones" id="modalObservaciones" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar Seguimiento</button>
                        <button type="button" class="btn btn-secondary" id="btnCancelar">Cancelar</button>
                    </div>





                </form>
            </div>
            <!-- Botón de Cancelar dentro del Modal -->



        </div>
    </div>
</div>




<script>
    // FORMULARIO MODAL 
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function(event) {
            console.log('ENTRO');
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var cuil = button.data('cuil').toString(); // Convertir cuil a cadena

            console.log("cuil", cuil);

            console.log("dni", cuil.substring(2, 10));
            //variables para obtener datos trasportados en BOTON EDIT
            var nombreapellido = button.data('nombreapellido');
            var fechanacimiento = button.data('fechanacimiento');
            var fechaactualiza = button.data('fechaactualiza');
            var diast = button.data('diast');
            var edad = button.data('edad');
            var uor = button.data('uor');
            var rats = button.data('rats');
            var id_meta4 = button.data('id_meta4');
            var comments = button.data('comments');
            var dni = cuil.substring(2, 10);

            var modal = $(this);

            //Asignar Valor a elementos del formulario MODAL
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #cuil').val(cuil);
            modal.find('.modal-body #dni').val(dni);
            modal.find('.modal-body #nombreapellido').val(nombreapellido);
            modal.find('.modal-body #fechanacimiento').val(fechanacimiento);
            modal.find('.modal-body #fechaactualiza').val(fechaactualiza);
            modal.find('.modal-body #diast').val(diast);
            modal.find('.modal-body #edad').val(edad);
            modal.find('.modal-body #uor').val(uor);
            modal.find('.modal-body #rats').val(rats);
            modal.find('.modal-body #id_meta4').val(id_meta4);
            modal.find('.modal-body #comments').val(comments);

            // Limpiar la tabla antes de llenarla
            var tableBody = modal.find('.modal-body #tramites-table-body');
            tableBody.empty();

            // Hacer la llamada AJAX a la API
            $.ajax({
                url: 'http://dic-alex-tst.mendoza.gov.ar:3000/futurosjubiladoshisto/' + dni,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var tramites = response.data;



                    tramites.forEach(function(tramite) {

                        //modal.find('.modal-body #idM4').val(tramite.ID_M4);

                        var formattedStartDate = formatDate(tramite.DT_START);
                        var formattedEndDate = formatDate(tramite.DT_END);



                        var row = '<tr>' +
                            '<td>' + formattedStartDate + '</td>' +
                            '<td>' + formattedEndDate + '</td>' +
                            '<td>' + tramite.COD_JUBILACION + ' ' + tramite.STD_N_EXT_ORGESP + '</td>' +
                            '<td>' + (tramite.OBSERVACION ? tramite.OBSERVACION : '') + '</td>' +
                            '<td>' + tramite.ID_SECUSER + '</td>' +
                            '<td>' + tramite.FECHA_ACTUALIZA + '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos de la API:', error);
                }
            });
        });

        function formatDate(dateString) {
            console.log(dateString);
            if (dateString === '4000-01-01T00:00:00.000Z') {
                return '  /  /  ';
            }
            // Extraer solo la parte de la fecha (YYYY-MM-DD)
            var datePart = dateString.slice(0, 10); // Tomamos solo "YYYY-MM-DD"
            var date = new Date(datePart); // Crear la fecha solo con la parte de la fecha
            var day = ('0' + date.getUTCDate()).slice(-2); // Usar getUTCDate para evitar conversiones
            var month = ('0' + (date.getUTCMonth() + 1)).slice(-2); // Usar getUTCMonth
            var year = date.getUTCFullYear(); // Usar getUTCFullYear

            return day + '/' + month + '/' + year;
        }



    });
</script>



<script>
    $(document).ready(function() {
        $('#editForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = "{{ route('futurosjubilados.store') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(response) {
                    // Aquí puedes actualizar la fila correspondiente con los nuevos datos
                    let id = $('#id').val();
                    let comments = $('#comments').val();

                    // Actualizar la celda de comentarios en la tabla
                    $('#row-' + id + ' .comments-column').text(comments);

                    // Actualizar el atributo data-comments del botón
                    $('button[data-id="' + id + '"]').data('comments', comments);

                    $('#editModal').find('.close').click();
                },
                error: function(response) {
                    // Manejo de errores
                    alert('Error al actualizar el comentario');
                }
            });
        });
    });
</script>







<script>
    document.getElementById('export_excel2').addEventListener('click', function(event) {
        event.preventDefault(); // Prevenir el envío del formulario

        // Capturar los datos del formulario
        var formData = new FormData(document.getElementById('editForm'));
        var data = {};
        formData.forEach((value, key) => {
            data[key] = value
        });

        // Convertir los datos a una matriz adecuada para SheetJS
        var dataArray = [
            ["Nombre y Apellido", data.nombreapellido],
            ["CUIL", data.cuil],
            ["DNI", data.dni],
            ["Id M4", data.idM4],
            ["UOR", data.uor],
            ["Fecha Nacimiento", data.fechanacimiento],
            ["Edad", data.edad],
            ["Fecha Actualización", data.fechaactualiza],
            ["Días Transcurridos", data.diast],
            ["Comentarios", data.comments],
            [" ", " "]
        ];

        // Capturar los datos de la tabla de historial de trámites
        var tramitesTable = document.getElementById('tramites-table-body');
        var tramitesData = [];
        tramitesTable.querySelectorAll('tr').forEach(function(row) {
            var rowData = [];
            row.querySelectorAll('td').forEach(function(cell) {
                rowData.push(cell.textContent);
            });
            tramitesData.push(rowData);
        });

        // Agregar los datos de la tabla al array de datos
        if (tramitesData.length > 0) {
            dataArray.push(["Historial de Trámites"]);
            dataArray.push(["F.Inicio", "F.Fin", "Trámite", "Observación", "Usuario", "Actualizado"]);
            dataArray = dataArray.concat(tramitesData);
        }

        // Crear un libro de trabajo y una hoja de trabajo
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.aoa_to_sheet(dataArray);

        // Agregar la hoja de trabajo al libro de trabajo
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        // Exportar el archivo Excel
        XLSX.writeFile(wb, 'reporte-' + data.nombreapellido + '.xlsx');
    });
</script>


</div>

<script>
    function openSeguimientoModal() {
        // Obtener el parámetro 'usuario' de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const m4user = urlParams.get('usuario'); // obtiene el valor de 'usuario'

        if (m4user) {
            // Realizar una solicitud AJAX al método seguimientoUsuarios
            $.ajax({
                //url: '/futurojubilados/seguimientoUsuarios/' + m4user,
                url: '{{ url("futurojubilados/seguimientoUsuarios") }}/' + m4user,
                method: 'GET',
                success: function(data) {
                    // Poblar el modal con los datos recibidos
                    document.getElementById('modalUsuario').innerText = data.usuario;
                    document.getElementById('modalM4User').value = data.usuario;
                    document.getElementById('modalObservaciones').value = data.observaciones;

                    // Abrir el modal
                    $('#seguimientoModal').modal('show');
                },
                error: function(xhr) {
                    // Manejo de errores
                    alert('Por favor registre al usuario en una Institución / Oficina');
                }
            });
        } else {
            alert('Seleccione un usuario por favor');
        }
    }
</script>

<script>
    document.getElementById('btnCancelar').addEventListener('click', function() {
        // Obtén el modal abierto actualmente
        var modal = document.querySelector('.modal.show');

        if (modal) {
            // Simula la acción de presionar la tecla ESC
            $(modal).modal('hide');
        }
    });
</script>



@endsection

@once
@push('scripts')

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

@endpush
@endonce