@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Bienvenido</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    {{-- <li class="breadcrumb-item active">Starter Page</li> --}}
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12">
                <h3>Cantida de pedidos</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $cantPedidosAnual }}</h3>
                        <p>Cantidad de pedidos del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $cantPedidosMes }}</h3>
                        <p>Cantidad de pedidos del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $cantPedidosDia }}</h3>
                        <p>Cantidad de pedidos del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes"></i>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Monto de pedidos</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosAnual ,2) }}</h3>
                        <p>Monto de pedidos del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosMes ,2) }}</h3>
                        <p>Monto de pedidos del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosDia ,2) }}</h3>
                        <p>Monto de pedidos del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Monto de pedidos entregados</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosEntregadoAnual ,2) }}</h3>
                        <p>Monto de pedidos entregados del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosEntregadoMes ,2) }}</h3>
                        <p>Monto de pedidos entregados del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosEntregadoDia ,2) }}</h3>
                        <p>Monto de pedidos entregados del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Monto de pedidos pendientes</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosPendienteAnual ,2) }}</h3>
                        <p>Monto de pedidos pendientes del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-area"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosPendienteMes ,2) }}</h3>
                        <p>Monto de pedidos pendientes del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-area"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosPendienteDia ,2) }}</h3>
                        <p>Monto de pedidos pendientes del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-area"></i>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Monto de pedidos enviados</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosEnviadoAnual ,2) }}</h3>
                        <p>Monto de pedidos enviados del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-location-arrow"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosEnviadoMes ,2) }}</h3>
                        <p>Monto de pedidos enviados del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-location-arrow"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($montoPedidosEnviadoDia ,2) }}</h3>
                        <p>Monto de pedidos enviados del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-location-arrow"></i>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Cantidad de pedidos pendientes</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosPendienteAnual ,2) }}</h3>
                        <p>Cantidad de pedidos pendientes del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-ol"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosPendienteMes ,2) }}</h3>
                        <p>Cantidad de pedidos pendientes del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-ol"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosPendienteDia ,2) }}</h3>
                        <p>Cantidad de pedidos pendientes del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-ol"></i>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Cantidad de pedidos enviados</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosEnviadoAnual ,2) }}</h3>
                        <p>Cantidad de pedidos enviados del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-ul"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosEnviadoMes ,2) }}</h3>
                        <p>Cantidad de pedidos enviados del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-ul"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosEnviadoDia ,2) }}</h3>
                        <p>Cantidad de pedidos enviados del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-ul"></i>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Cantidad de pedidos entregados</h3>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosEntregadoAnual ,2) }}</h3>
                        <p>Cantidad de pedidos entregados del año</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosEntregadoMes ,2) }}</h3>
                        <p>Cantidad de pedidos entregados del mes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($cantPedidosEntregadoDia ,2) }}</h3>
                        <p>Cantidad de pedidos entregados del día</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NEGOCIO</th>
                                        <th>CLIENTE</th>
                                        <th>TOTAL</th>
                                        <th>FECHA</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimosPedidos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->negocio->nombre }}</td>
                                            <td>{{ $item->cliente->name }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>{{ $item->fecha }}</td>
                                            <td>
                                                @if($item->estado == 'Pendiente')
                                                    <span class="badge badge-danger">Pendiente</span>
                                                @elseif($item->estado == 'Enviado')
                                                    <span class="badge badge-warning">Enviado</span>
                                                @else
                                                    <span class="badge badge-success">Entregado</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/pedidos/ver/'.$item->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
