@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">


        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuarios</h1>
                <div class="col-sm">
                    <nav class="navbar navbar-light bg-light">
                        <form class="form-inline" method {{route('usuarios.index')}}>
                            <input name='nombre' class="form-control mr-sm-2" type="search"
                                placeholder="Buscar por nombre, apellido o nombre usuario" value="{{ old('nombre') }}" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </nav>
                </div>
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
            @include('usuarios.table')

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>
</div>

@endsection