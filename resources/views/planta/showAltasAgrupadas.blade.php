@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Altas Agrupadas por UOR</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>UOR</th>
                    <th>CANTIDAD</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($data['rows']) && is_array($data['rows']))
                    @foreach($data['rows'] as $row)
                        <tr>
                            <td>{{ $row['UOR'] }}</td>
                            <td>{{ $row['CANTIDAD'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">No se encontraron datos.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
