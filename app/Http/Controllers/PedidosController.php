<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index(){
        $pedidos = Pedidos::with('cliente', 'negocio')->orderBy('id', 'desc')->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    public function create(){
        return view('pedidos.create');
    }

    public function cambiarEstado(Request $request, $id){
        $pedido = Pedidos::find($id);
        $pedido->estado = $request->estado;
        if ($pedido->save()) {
            return redirect('/pedidos')->with('success', 'Estado actualizado!');
        } else {
            return back()->with('error', 'Estado no actualizado!');
        }
    }

    public function show($id){
        $pedido = Pedidos::with('cliente', 'negocio', 'detalles.producto')->find($id);

        return view('pedidos.show', compact('pedido'));
    }
}
