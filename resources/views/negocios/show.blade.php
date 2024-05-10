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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
