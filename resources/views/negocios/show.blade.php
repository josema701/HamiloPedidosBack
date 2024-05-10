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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Detalle del negocio</div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ $negocio->getImagenUrl() }}" alt="Img" class="border rounded" height="180px">
                            <h3 class="mt-3">{{ $negocio->nombre }}</h3>
                        </div>
                        <div class="mt-3">
                            <p><strong>Descripción:</strong> <br> {{ $negocio->descripcion }}</p>
                            <p><strong>Estado:</strong>
                                @if ($negocio->estado == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">Inactivo</span>
                                @endif
                            </p>
                            <p><strong>Fecha de creación:</strong> {{ $negocio->created_at }}</p>
                        </div>
                        <div class="m-3 text-center">
                            <a href="{{ url('/negocios') }}" class="btn btn-primary">Volver al listado</a>
                            <a href="{{ url('/negocios/actualizar/'.$negocio->id) }}" class="btn btn-warning">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listado de Productos</div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGEN</th>
                                        <th>NOMBRE</th>
                                        <th>COSTO</th>
                                        <th>DESCRIPCION</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <img src="{{ $item->getImagenUrl() }}" alt="imagen" height="40px" >
                                            </td>
                                            <td>{{ $item->nombre }}</td>
                                            <td>{{ $item->costo }}</td>
                                            <td>{{ $item->descripcion }}</td>
                                            <td>
                                                @if ($item->estado == true)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/productos/actualizar/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                @if ($item->estado == true)
                                                    <a href="{{ url('/productos/estado/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></a>
                                                @else
                                                    <a href="{{ url('/productos/estado/'.$item->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $productos->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
