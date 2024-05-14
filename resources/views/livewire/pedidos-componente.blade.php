<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @include('includes.alertas')

    @if ($negocio_id > 0)
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Seleccionar productos</div>
                    <div class="card-body">
                        <input wire:model.live="buscarProducto" type="text" class="form-control mb-3" placeholder="Buscar...">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>IMAGEN</th>
                                        <th>PRODUCTO</th>
                                        <th>COSTO</th>
                                        <th>AGREGAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $itempro)
                                        <tr>
                                            <td>
                                                <img src="{{ $itempro->getImagenUrl() }}" alt="img" height="40px">
                                            </td>
                                            <td>{{ $itempro->nombre }}</td>
                                            <td>{{ $itempro->costo }}</td>
                                            <td>
                                                <button wire:click="agregarCarrito({{ $itempro }})" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $productos->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Carrito</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Buscar Cliente:</label>
                                    <input type="text" wire:model="buscarCliente" class="form-control" placeholder="Ingresar el umero de telefono">
                                    @error('buscarCliente') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Buscar</label> <br>
                                    <button wire:click="filtrarClientes()" class="btn btn-primary">
                                        Buscar <i class="fa fa-spinner" wire:loading wire:target="filtrarClientes()"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Seleccionar el cliente</label>
                                    <select wire:model.live="cliente_id" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach ($clientes as $itemcli)
                                            <option value="{{ $itemcli->id }}">{{ $itemcli->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th width="10%">Cantidad</th>
                                        <th>Costo</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carrito as $key => $itemcar)
                                        <tr>
                                            <td>{{ $itemcar['nombre'] }}</td>
                                            <td>
                                                <input wire:model.live="carrito.{{ $key }}.cantidad" wire:change="calcularTotal()" type="number" step="any" class="form-control">
                                            </td>
                                            <td>{{ $itemcar['costo'] }}</td>
                                            <td>{{ $itemcar['subtotal'] }}</td>
                                            <td>
                                                <button wire:click="quitarProducto({{ $key }})" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-times" ></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Total</td>
                                        <td>{{ $total }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @if($cliente_id > 0 && $total > 0)
                            <div class="text-center">
                                <button wire:click="guardarPedido()" class="btn btn-success">
                                    guardar pedido <i class="fa fa-spinner" wire:loading wire:target="guardarPedido()" ></i>
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>




    @else

    <div class="row justify-content-center">
        @foreach ($negocios as $itemneg)
            <div class="col-md-4 p-1">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <img src="{{ $itemneg->getImagenUrl() }}" alt="" class="rounded" height="200px">
                        <h2>{{ $itemneg->nombre }}</h2>
                        <button wire:click="seleccionaNegocio({{ $itemneg->id }})" class="btn btn-primary">Seleccionar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @endif


</div>
