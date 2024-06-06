@extends('layouts.app')

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
     
        


</style>

@section('content')



<div class="container">
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
            <div class="col-md-4 form-group">
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

            <div class="col-md-4 form-group">
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

            <div class="col-md-4 form-group">
                <label for="search">Buscar persona:</label>
                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Buscar por nombre o CUIL">
            </div>
        </div>


        <!-- SEGUNDA FILA -->

        <div class="row">
            <div class="col-md-4 form-group">
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

            <div class="col-md-4 form-group">
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

            <div class="col-md-4 form-group">
                <label for="comment">Filtro por observaciones:</label>
                <select id="comment" name="comment" class="form-control" onchange="this.form.submit()">
                    <option value="" {{ request('comment') === '' ? 'selected' : '' }}>Todos</option>
                    <option value="con" {{ request('comment') === 'con' ? 'selected' : '' }}>Con observaciones</option>
                    <option value="sin" {{ request('comment') === 'sin' ? 'selected' : '' }}>Sin observaciones</option>
                </select>
            </div>

        </div>




        <button type="submit" class="btn btn-primary">Buscar</button>


    </form>




    

    <div class="card">
        <p>Total de futuros jubilados: <span class="number">{{ $totalJubilados }}</span></p>
    </div>    
 
    <!-- Tabla -->
    
    <table class="table table-striped mt-2" id="futuros-table">        
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>CUIL</th>
                <th>Nombres</th>
                <th>Edad</th>
                <th>UOR</th>
                <th>Institución</th>
                <th>RATS</th>
                <th>Cod.</th>
                <th>Obs</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($futurosjubilados as $futuro)
            <tr id="row-{{ $futuro->id }}">
                <td>{{ $futuro->cuil }}</td>
                <td>{{ $futuro->nombreapellido }}</td>
                <td>{{ $futuro->edad }}</td>
                <td data-toggle="tooltip" title="{{ $futuro->descripcionuor }} {{ $futuro->dependencia }}">{{ substr($futuro->descripcionuor, 0, 20) }} {{ substr($futuro->dependencia, 0, 20) }}</td>
                <td>{{ $futuro->etiqueta }}</td>
                <td>{{ $futuro->rats }}</td>
                <td data-toggle="tooltip" title="{{ $futuro->last_cod_jub_desc }}">{{ $futuro->last_cod_jub }}</td>
                <td class="comments-column" id="comments-{{ $futuro->id }}">{{ $futuro->comments }}</td>
                <!-- <td>
                    <a href="{ { route('futurojubilado.show', $futuro->cuil) } }" class="btn btn-info">Ver</a>
                </td> -->
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="{{ $futuro->id }}" data-cuil="{{ $futuro->cuil }}" data-nombreapellido="{{ $futuro->nombreapellido }}" data-comments="{{ $futuro->comments }}">Edit</button>
                    </button>

                </td>
            </tr>



            @endforeach
        </tbody>
    </table>


    <div class="card mt-20">
        <p>Total de futuros jubilados: <span class="number">{{ $totalJubilados }}</span></p>
    </div>        

    <div class="mt-20">
        <p>Alex Futuros Jubilados - DIC 2024</p>
    </div>    

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- Cambiamos a modal-lg para hacerlo más grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="editModalLabel">Editar</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="cuil" name="cuil">

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="nombreapellido">Nombre y Apellido</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="nombreapellido" name="nombreapellido" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="cuil">CUIL</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="cuil" name="cuil" value=" " readonly>
                            </div>

                            <div class="col-md-1">
                                <label for="dni">DNI</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="dni" name="dni" value=" " readonly>
                            </div>

                            <div class="col-md-1">
                                <label for="idM4">Id M4</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="idM4" name="idM4" value=" " readonly>
                            </div>


                        </div>






                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="comments">Comentarios</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Historial de Trámites</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>F.Inicio</th>
                                        <th>F.Fin</th>
                                        <th>Trámite</th>
                                        <th>Observación</th>
                                        <th>Usuario</th>
                                        <th>Actualizado</th>
                                    </tr>
                                </thead>
                                <tbody id="tramites-table-body">
                                    <!-- Aquí se llenarán los datos de la API -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal -->











</div>

<script>
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function(event) {
            console.log('ENTRO');
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var cuil = button.data('cuil').toString(); // Convertir cuil a cadena

            console.log("cuil", cuil);

            console.log("dni", cuil.substring(2, 10));

            var nombreapellido = button.data('nombreapellido');
            var comments = button.data('comments');
            var dni = cuil.substring(2, 10);

            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #cuil').val(cuil);
            modal.find('.modal-body #dni').val(dni);
            modal.find('.modal-body #nombreapellido').val(nombreapellido);
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

                        modal.find('.modal-body #idM4').val(tramite.ID_M4);

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
            var date = new Date(dateString);
            var day = ('0' + date.getDate()).slice(-2);
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var year = date.getFullYear();
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



</div>



@endsection