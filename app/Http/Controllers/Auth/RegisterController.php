<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'digits_between:8,15', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $paraOtp = rand(100000, 999999);

        $paraTelefono = $data['pais'] . $data['telefono'];
        // if(str_contains($data['telefono'], '+')){
        //     $paraTelefono = $data['telefono'];
        // } else {
        //     $paraTelefono = '+' . $data['telefono'];
        // }

        $usuario = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telefono' => $paraTelefono,
            'tipo' => 'Negocio',
            'otp' => $paraOtp,
            'verificado' => false,
            'password' => Hash::make($data['password']),
        ]);

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

        return $usuario;
    }
}
