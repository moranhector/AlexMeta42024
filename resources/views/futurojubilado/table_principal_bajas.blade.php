<table class="table-auto w-full" id="futuros-table">
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>CUIL</th>
                <th>Nombres</th>
                <th>Edad</th>
                <th>Fecha Nac.</th>
                <th>Lugar de Trabajo</th>
                <th>Dependencia</th>
                <!-- <th>RATS</th> -->
                <th>Código Trámite</th>
                <th>Días desde último movimiento</th>
                <th>Observación Usuario responsable</th>
                <th>Auditoría D.G.RRHH</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($futurosjubilados as $futuro)
            <tr id="row-{{ $futuro->id }}">
                <td  data-toggle="tooltip" title="{{ $futuro->periodo }}">{{ $futuro->cuil }}</td>
                <td>{{ $futuro->nombreapellido }}</td>
                <td>{{ $futuro->edad }}</td>
                <td>{{ Carbon\Carbon::parse($futuro->fechanacimiento)->format('d/m/Y') }}</td>
                <td data-toggle="tooltip" title="{{ $futuro->descripcionuor }} {{ $futuro->dependencia }}">{{ substr($futuro->descripcionuor, 0, 20) }} {{ substr($futuro->dependencia, 0, 20) }}</td>
                <td>{{ $futuro->etiqueta }}</td>
                <!-- <td>{ { $futuro->rats } }</td> -->
                <td data-toggle="tooltip" title="{{ $futuro->last_cod_jub_desc }}">{{ $futuro->last_cod_jub }}</td>

                @if (!empty($futuro->fecha_actualiza))
                <td data-toggle="tooltip" title="{{ Carbon\Carbon::parse($futuro->fecha_actualiza)->format('d/m/Y') }}">{{ Carbon\Carbon::parse($futuro->fecha_actualiza)->diffInDays() }}</td>
                @else
                <td data-toggle="tooltip" title="Sin trámites">Sin registros Meta4</td>

                @endif

                <td
                    data-toggle="tooltip" 
                    title="{{ $futuro->last_observacion }}" 
                    id="observa-{{ $futuro->id }}">

                    {{ $futuro->id_secuser }}: {{ substr( $futuro->last_observacion , 0, 40) }}
                </td>
                <td 
                    data-toggle="tooltip" 
                    title="{{ $futuro->comments }}"                 
                    class="comments-column" 
                    id="comments-{{ $futuro->id }}">{{ substr( $futuro->comments , 0, 100)  }}
                </td>

                <!-- <td>
                    <a href="{ { route('futurojubilado.show', $futuro->cuil) } }" class="btn btn-info">Ver</a>
                </td> -->
                <td>
                    <button type="button" class="btn btn-warning" 
                    data-toggle="modal" 
                    data-target="#editModal" 
                    data-id="{{ $futuro->id }}" 
                    data-cuil="{{ $futuro->cuil }}" 
                    data-nombreapellido="{{ $futuro->nombreapellido }}" 
                    data-fechanacimiento="{{ Carbon\Carbon::parse($futuro->fechanacimiento)->format('d/m/Y') }}" 
                    data-id_meta4 = "{{$futuro->id_meta4}}"
                    data-edad="{{ $futuro->edad }}" 
                        @if (!empty($futuro->fecha_actualiza))
                            data-fechaactualiza="{{ Carbon\Carbon::parse($futuro->fecha_actualiza)->format('d/m/Y') }}"
                            data-diast="{{ Carbon\Carbon::parse($futuro->fecha_actualiza)->diffInDays() }}"
                        @else
                            data-fechaactualiza="Sin registros Meta4"
                            data-diast="Sin registros Meta4"
                        @endif

                        data-uor= "{{ $futuro->descripcionuor }} {{ $futuro->dependencia }}"
                        data-rats= "{{ $futuro->rats }}"
                        data-comments="{{ $futuro->comments }}">Edit</button>
                    </button>

                </td>
            </tr>



            @endforeach
        </tbody>
    </table>