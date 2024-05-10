@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Negocios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Negocios</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listado de Empresas</div>

                    <div class="card-body">
                        @include('includes.alertas')
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <a href="{{ url('/negocios/registrar') }}" class="btn btn-primary float-right">Nuevo</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>IMAGEN</th>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCION</th>
                                                <th>ESTADO</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($negocios as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        <img src="{{ $item->getImagenUrl() }}" alt="imagen" height="40px" >
                                                    </td>
                                                    <td>{{ $item->nombre }}</td>
                                                    <td>{{ $item->descripcion }}</td>
                                                    <td>
                                                        @if ($item->estado == true)
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/negocios/ver/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ url('/negocios/actualizar/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                        @if ($item->estado == true)
                                                            <a href="{{ url('/negocios/estado/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></a>
                                                        @else
                                                            <a href="{{ url('/negocios/estado/'.$item->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $negocios->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
