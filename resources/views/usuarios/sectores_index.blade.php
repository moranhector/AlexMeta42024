@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">


        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sectores</h1>

            </div>

            <div class="row mb-2">

            </div>
        </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table" id="usuarios-table">
                    <thead>
                        <tr>
                            <th>Codigo Sector Interno</th>
                            <th>Sector</th>

                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sectores as $sector)
                        <tr>
      
                            <td>{{ $sector->codigo_sector_interno }}</td>
                            <td>{{$sector->cargo }}</td>
 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>




            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>
</div>

@endsection