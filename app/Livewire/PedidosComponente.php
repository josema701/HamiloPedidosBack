<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Pedidos;
use Livewire\Component;
use App\Models\Negocios;
use App\Models\Productos;
use Livewire\WithPagination;
use App\Models\PedidosDetalles;

class PedidosComponente extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $negocio_id, $negocios=[], $buscarProducto='', $buscarCliente='', $cliente_id, $clientes=[], $total=0;
    public $carrito = [
        // [
        //     'producto_id' => 0,
        //     'nombre' => '',
        //     'cantidad' => 0,
        //     'costo' => 0,
        //     'subtotal' => 0
        // ]
    ];


    public function mount(){
        $this->negocios = Negocios::where('usuario_id', auth()->user()->id)->get();
    }

    public function render()
    {
        $productos = Productos::where('nombre', 'LIKE', '%'.$this->buscarProducto.'%')
                                ->where('negocio_id', $this->negocio_id)
                                ->paginate(10);

        return view('livewire.pedidos-componente', compact('productos'));
    }

    // seleccionar el negocio
    public function seleccionaNegocio($param){
        $this->negocio_id = $param;
    }

    public function filtrarClientes(){
        $this->validate([
            'buscarCliente' => 'required|string|min:5'
        ]);

        $this->clientes = User::where('telefono', 'LIKE', '%'.$this->buscarCliente.'%')
                                // ->where('tipo', 'Cliente')
                                ->get();

    }

    // agregar carrito
    public function agregarCarrito($item){
        // verificar si el item ya existe en el carrito
        $existe = false;
        foreach($this->carrito as $indice => $itemcar){
            if($itemcar['producto_id'] == $item['id']){
                $existe = true;
                $this->carrito[$indice]['cantidad']++;
                $this->carrito[$indice]['subtotal'] == $this->carrito[$indice]['cantidad'] * $this->carrito[$indice]['costo'];
            }
        }

        if($existe == false){
            $elemento = [
                'producto_id' => $item['id'],
                'nombre' => $item['nombre'],
                'cantidad' => 1,
                'costo' => $item['costo'],
                'subtotal' => $item['costo']
            ];

            $this->carrito[] = $elemento;
        }

        $this->calcularTotal();
    }

    public function calcularTotal(){
        $this->total = 0;
        foreach($this->carrito as $key => $item){
            $this->carrito[$key]['subtotal'] = $item['cantidad'] * $item['costo'];
            $this->total = $this->total + $this->carrito[$key]['subtotal'];
        }
    }

    public function quitarProducto($posicion){
        unset($this->carrito[$posicion]);
        $this->calcularTotal();
    }

    // guardarPedido
    public function guardarPedido(){
        $this->validate([
            'cliente_id' => 'required|exists:users,id',
            'negocio_id' => 'required|exists:negocios,id',
            'total' => 'required|numeric'
        ]);

        $pedido = new Pedidos();
        $pedido->cliente_id  = $this->cliente_id;
        $pedido->negocio_id = $this->negocio_id;
        $pedido->total = $this->total;
        $pedido->fecha = now(); // date('Y-m-d H:i:s');
        $pedido->comentarios = 'Pedido en local/tienda';
        $pedido->coordenadas = '';
        $pedido->estado = 'Pendiente';
        if ($pedido->save()) {
            // registrar los deltalles del pedido
            foreach($this->carrito as $item){
                $detalle = new PedidosDetalles();
                $detalle->pedido_id = $pedido->id;
                $detalle->producto_id = $item['producto_id'];
                $detalle->cantidad = $item['cantidad'];
                $detalle->costo = $item['costo'];
                $detalle->save();
            }

            session()->flash('success', 'Pedido registrado correctamente!');
            $this->reset(['cliente_id', 'total', 'carrito', 'buscarProducto', 'buscarCliente', 'negocio_id', 'clientes']);

        } else {
            session()->flash('error', 'No se pudo registrar el pedido!');
        }
    }
}
