@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Futuros Jubilados</h1>





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
                    @foreach ($estados as $estado)
                    <option value="{{ $estado->last_cod_jub }}" {{ request('estado') == $estado->last_cod_jub ? 'selected' : '' }}>
                        {{ $estado->last_cod_jub }} - {{ $estado->last_cod_jub_desc }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="search">Buscar persona:</label>
                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Buscar por nombre o CUIL">
            </div>
        </div>


        <div class="row">
            <div class="col-md-4 form-group">
                <label for="regimen">Selecciona un régimen:</label>
                <select id="regimen" name="regimen" class="form-control" onchange="this.form.submit()">
                    <option value="">Todos los regímenes</option>
                    @foreach ($regimenes as $regimen)
                    

                    <option value="{{ $regimen->regimen }}"  {{ request('regimen') == $regimen->regimen ? 'selected' : '' }} >
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


        </div>




        <button type="submit" class="btn btn-primary">Buscar</button>


    </form>




    <p>Total de futuros jubilados: {{ $totalJubilados }}</p>
<!-- Tabla -->
<!-- Tabla -->
<table class="table">
    <thead>
        <tr>
            <!-- <th>ID</th> -->
            <th>CUIL</th>
            <th>Nombre y Apellido</th>
            <th>Edad</th>
            <th>UOR</th>
            <th>Etiqueta</th>
            <th>RATS</th>
            <th>Cod.</th>
            <th>Obs</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($futurosjubilados as $futuro)
        <tr>
            <!-- <td>{{ $futuro->id }}</td> -->
            <td>{{ $futuro->cuil }}</td>
            <td>{{ $futuro->nombreapellido }}</td>
            <td>{{ $futuro->edad }}</td>
            <td data-toggle="tooltip" title="{{ $futuro->descripcionuor }} {{ $futuro->dependencia }}">{{ substr($futuro->descripcionuor, 0, 20) }} {{ substr($futuro->dependencia, 0, 20) }}</td>
            <td>{{ $futuro->etiqueta }}</td>
            <td>{{ $futuro->rats }}</td>
            <td data-toggle="tooltip" title="{{ $futuro->last_cod_jub_desc }}">{{ $futuro->last_cod_jub }}</td>
            <td>{{ $futuro->comments }}</td>
            <td>
                <a href="{{ route('futurojubilado.show', $futuro->cuil) }}" class="btn btn-info">Ver</a>
            </td>
            <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="{{ $futuro->id }}" data-cuil="{{ $futuro->cuil }}" data-nombreapellido="{{ $futuro->nombreapellido }}" data-comments="{{ $futuro->comments }}">Edit</button>
            </td>
            <td>
                <a href="{{ route('futurojubilado.destroy', $futuro->cuil) }}" class="btn btn-danger">Del</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Comentarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST" action="{{ route('futurosjubilados.store') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="cuil" name="cuil">
                    <div class="form-group">
                        <label for="nombreapellido">Nombre y Apellido</label>
                        <input type="text" class="form-control" id="nombreapellido" name="nombreapellido" readonly>
                    </div>
                    <div class="form-group">
                        <label for="comments">Comentarios</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
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

<script>
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function(event) {
            console.log('ENTRO');
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var cuil = button.data('cuil')
            var nombreapellido = button.data('nombreapellido')
            var comments = button.data('comments')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #cuil').val(cuil)
            modal.find('.modal-body #nombreapellido').val(nombreapellido)
            modal.find('.modal-body #comments').val(comments)
        })
    });
</script>





</div>



@endsection