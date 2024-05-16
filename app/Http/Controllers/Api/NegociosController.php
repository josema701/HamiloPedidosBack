<?php

namespace App\Http\Controllers\Api;

use App\Models\Negocios;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NegociosController extends Controller
{
    public function index(){
        $negocios = Negocios::where('estado', true)->orderBy('id', 'desc')->paginate(10);

        foreach ($negocios as $negocio) {
            $negocio->imagen = $negocio->getImagenUrl();
        }

        return response()->json([
            'mensaje' => 'Datos cargados correctamente',
            'datos' => $negocios
        ], 200);
    }
}
