@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Productos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Productos</li>
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
                    <div class="card-header">Registro de prducto</div>

                    <div class="card-body">
                        <form action="{{ url('/productos/registrar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="negocio_id">Negocio</label>
                                <select  name="negocio_id" class="form-control" value="{{ old('negocio_id') }}">
                                    <option value="">Seleccione...</option>
                                    @foreach ($negocios as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('negocio_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                                @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="costo">Costo</label>
                                <input type="number" name="costo" class="form-control" value="{{ old('costo') }}">
                                @error('costo') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" name="imagen" class="form-control" accept="image/*" value="{{ old('imagen') }}">
                                @error('imagen') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea name="descripcion" class="form-control" cols="30" rows="2">{{ old('descripcion') }}</textarea>
                                @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
