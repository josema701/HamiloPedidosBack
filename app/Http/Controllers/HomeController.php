<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pedidos;
use Twilio\Rest\Client;
use App\Models\Negocios;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $arrayNeg = Negocios::where('usuario_id', auth()->user()->id)->get()->pluck('id');

        // cantidad de pedidos Anual
        $cantPedidosAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->whereYear('fecha', date('Y'))->count();
        // cantidad de pedidos Mensual
        $cantPedidosMes = Pedidos::whereIn('negocio_id', $arrayNeg)->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->count();
        // cantidad de pedidos del dia
        $cantPedidosDia = Pedidos::whereIn('negocio_id', $arrayNeg)->whereDate('fecha', date('Y-m-d'))->count();

        // monto total de pedidos Anual
        $montoPedidosAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->whereYear('fecha', date('Y'))->sum('total');
        // monto total de pedidos Mensual
        $montoPedidosMes = Pedidos::whereIn('negocio_id', $arrayNeg)->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->sum('total');
        // monto total de pedidos del dia
        $montoPedidosDia = Pedidos::whereIn('negocio_id', $arrayNeg)->whereDate('fecha', date('Y-m-d'))->sum('total');

        // monto total de ventas Entregadas Anual
        $montoPedidosEntregadoAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Entregado')->whereYear('fecha', date('Y'))->sum('total');
        // monto total de ventas Entregadas Mensual
        $montoPedidosEntregadoMes = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Entregado')->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->sum('total');
        // monto total de ventas Entregadas del Dia
        $montoPedidosEntregadoDia = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Entregado')->whereDate('fecha', date('Y-m-d'))->sum('total');

        // monto total de ventas Pendiente Anual
        $montoPedidosPendienteAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Pendiente')->whereYear('fecha', date('Y'))->sum('total');
        // monto total de ventas Pendiente Mensual
        $montoPedidosPendienteMes = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Pendiente')->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->sum('total');
        // monto total de ventas Pendiente del Dia
        $montoPedidosPendienteDia = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Pendiente')->whereDate('fecha', date('Y-m-d'))->sum('total');

        // monto total de ventas Enviado Anual
        $montoPedidosEnviadoAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Enviado')->whereYear('fecha', date('Y'))->sum('total');
        // monto total de ventas Enviado Mensual
        $montoPedidosEnviadoMes = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Enviado')->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->sum('total');
        // monto total de ventas Enviado del Dia
        $montoPedidosEnviadoDia = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Enviado')->whereDate('fecha', date('Y-m-d'))->sum('total');

        // cantidad de pedidos Pendientes Anual
        $cantPedidosPendienteAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Pendiente')->whereYear('fecha', date('Y'))->count();
        // cantidad de pedidos Pendientes Mensual
        $cantPedidosPendienteMes = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Pendiente')->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->count();
        // cantidad de pedidos Pendientes Diario
        $cantPedidosPendienteDia = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Pendiente')->whereDate('fecha', date('Y-m-d'))->count();

        // cantidad de pedidos Enviados Anual
        $cantPedidosEnviadoAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Enviado')->whereYear('fecha', date('Y'))->count();
        // cantidad de pedidos Enviados Mensual
        $cantPedidosEnviadoMes = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Enviado')->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->count();
        // cantidad de pedidos Enviados Diario
        $cantPedidosEnviadoDia = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Enviado')->whereDate('fecha', date('Y-m-d'))->count();

        // cantidad de pedidos Entregados Anual
        $cantPedidosEntregadoAnual = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Entregado')->whereYear('fecha', date('Y'))->count();
        // cantidad de pedidos Entregados Mensual
        $cantPedidosEntregadoMes = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Entregado')->whereYear('fecha', date('Y'))->whereMonth('fecha', date('m'))->count();
        // cantidad de pedidos Entregados Diario
        $cantPedidosEntregadoDia = Pedidos::whereIn('negocio_id', $arrayNeg)->where('estado', 'Entregado')->whereDate('fecha', date('Y-m-d'))->count();


        // listado de los ultimos 10 pedidos
        $ultimosPedidos = Pedidos::whereIn('negocio_id', $arrayNeg)->orderBy('id', 'desc')->take(10)->get();

        return view('home', compact(
                                'cantPedidosAnual',
                                'cantPedidosMes',
                                'cantPedidosDia',
                                'montoPedidosAnual',
                                'montoPedidosMes',
                                'montoPedidosDia',
                                'montoPedidosEntregadoAnual',
                                'montoPedidosEntregadoMes',
                                'montoPedidosEntregadoDia',
                                'montoPedidosPendienteAnual',
                                'montoPedidosPendienteMes',
                                'montoPedidosPendienteDia',
                                'montoPedidosEnviadoAnual',
                                'montoPedidosEnviadoMes',
                                'montoPedidosEnviadoDia',
                                'cantPedidosPendienteAnual',
                                'cantPedidosPendienteMes',
                                'cantPedidosPendienteDia',
                                'cantPedidosEnviadoAnual',
                                'cantPedidosEnviadoMes',
                                'cantPedidosEnviadoDia',
                                'cantPedidosEntregadoAnual',
                                'cantPedidosEntregadoMes',
                                'cantPedidosEntregadoDia',
                                'ultimosPedidos'
                                ));
    }

    // PARA VERIFICAR EL OTP
    public function verificar(Request $request){

        $this->validate($request, [
            'otp' => 'required|numeric'
        ]);

        $usuario = User::where('id', auth()->user()->id)->first();

        if($usuario->otp == $request->otp){
            $usuario->verificado = true;
            $usuario->save();
            return redirect('/home');
        } else {
            return back()->with('error', 'El codigo OTP es incorrecto');
        }
    }

    // PARA REENVIAR OTP
    public function reenviar(){
        $paraOtp = rand(100000, 999999);

        $usuario = User::where('id', auth()->user()->id)->first();
        $usuario->otp = $paraOtp;
        $usuario->save();

        // enviamos el SMS con el OTP
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $from = env('TWILIO_FROM');

        try {
            $client = new Client($sid, $token);

            $client->messages->create($usuario->telefono, [
                'from' => $from,
                'body' => "Tu codigo OTP es: " . $paraOtp . ". No lo compartas con nadie."
            ]);
            return redirect('/home')->with('info', 'Se envió el OTP a tu número de teléfono');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'No se pudo enviar el mensaje. Intentalo de nuevo.');
        }
    }
}
