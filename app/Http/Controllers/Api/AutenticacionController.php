<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutenticacionController extends Controller
{
    // FUNCION DE REGISTRO
    public function registro(Request $request){
        $this->validate($request, [
            'name' => 'required|string|min:2|max:200',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|string|min:6|max:15',
            'password' => 'required|string|min:6|max:20|confirmed'
        ]);

        $paraOtp = rand(100000, 999999);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->password = bcrypt($request->password);
        $usuario->tipo = 'Cliente';
        $usuario->verificado = false;
        $usuario->otp = $paraOtp;
        if($usuario->save()){

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
            } catch (\Throwable $th) {
                //throw $th;
            }

            $token = $usuario->createToken('Personal token')->plainTextToken;
            return response()->json([
                'mensaje' => 'Registro exitoso!',
                'usuario' => $usuario,
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'mensaje' => 'No se pudo registrar!'
            ]);
        }
    }

    // FUNCION PARA VERIFICAR OTP
    public function verificar(Request $request){

        $this->validate($request, [
            'otp' => 'required|numeric'
        ]);

        $usuario = User::where('id', auth()->user()->id)->first();

        if($usuario->otp == $request->otp){
            $usuario->verificado = true;
            $usuario->save();
            return response()->json([
                'mensaje' => 'Verificación exitosa!',
                'usuario' => $usuario,
            ]);
        } else {
            return response()->json([
                'mensaje' => 'El codigo OTP es incorrecto!'
            ]);
        }
    }



    // FUNCION PARA LOGIN
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|string|min:6|max:20'
        ]);

        if (\Auth::attempt(['email' => $request->email, 'password' => $request->password]) || \Auth::attempt(['telefono' => $request->email, 'password' => $request->password])) {
            $usuario = $request->user();
            $token = $usuario->createToken('Personal token')->plainTextToken;
            return response()->json([
                'mensaje' => 'Inicio exitoso!',
                'usuario' => $usuario,
                'token' => $token,
            ]);

        } else {
            return response()->json([
                'mensaje' => 'Credenciales incorrectas!'
            ], 401);
        }
    }
}
