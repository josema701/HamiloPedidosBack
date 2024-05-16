<?php

namespace App\Http\Controllers\Api;

use App\Models\Negocios;
use App\Models\Productos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductosController extends Controller
{
    public function index($id){
        $negocio = Negocios::where('id', $id)->first();
        $negocio->imagen = $negocio->getImagenUrl();

        $productos = Productos::where('negocio_id', $id)->orderBy('id', 'desc')->paginate(10);

        foreach ($productos as $producto) {
            $producto->imagen = $producto->getImagenUrl();
        }

        return response()->json([
            'mensaje' => 'Datos cargados correctamente',
            'datos' => $productos,
            'negocio' => $negocio
        ], 200);
    }
}
