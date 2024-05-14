<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Twilio\Rest\Client;
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

    public function cambiarEstado($id, $estado){
        $pedido = Pedidos::with('cliente')->find($id);
        $pedido->estado = $estado;
        if ($pedido->save()) {
            // el estado es Enviado? enviar sms : no hacer nada
            if ($estado == 'Enviado') {
                // enviar sms
                try {
                    $sid = env('TWILIO_SID');
                    $token = env('TWILIO_TOKEN');
                    $from = env('TWILIO_FROM');
                    $to = $pedido->cliente->telefono;
                    $mensaje = "Su pedido con ID: ".$pedido->id." ha sido enviado. Gracias por su compra!";
                    $client = new Client($sid, $token);
                    $client->messages->create($to, [
                        'from' => $from,
                        'body' => $mensaje
                    ]);
                } catch (\Throwable $th) {
                    return back()->with('success', 'Estado actualizado!, pero el SMS no se pudo enviar!');
                }
            }

            return back()->with('success', 'Estado actualizado!');
        } else {
            return back()->with('error', 'Estado no actualizado!');
        }
    }

    public function show($id){
        $pedido = Pedidos::with('cliente', 'negocio', 'detalles.producto')->find($id);

        return view('pedidos.show', compact('pedido'));
    }
}
