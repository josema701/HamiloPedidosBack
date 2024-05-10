<?php

namespace App\Http\Controllers;

use App\Models\Negocios;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductosController extends Controller
{
    public function index(){
        // $productos = Productos::with('negocio')
        //     ->whereHas('negocio', function($query){
        //         $query->where('usuario_id', auth()->user()->id);
        //     })
        //     ->orderBy('id', 'desc')->paginate(10);

        // $negocio = Negocios::where('usuario_id', auth()->user()->id)->get();

        // OPCION 2
        // $arrayNegocios = [];
        // foreach ($negocio as $key => $value) {
        //     $arrayNegocios[] = $value->id;
        // }

        // $productos = Productos::whereIn('negocio_id', $arrayNegocios)->orderBy('id', 'desc')->paginate(10);

        // OPCION 3
        $arrayNeg = Negocios::where('usuario_id', auth()->user()->id)->get()->pluck('id');
        $productos = Productos::whereIn('negocio_id', $arrayNeg)->orderBy('id', 'desc')->paginate(10);



        return view('productos.index', compact('productos'));
    }

    public function create(){
        $negocios = Negocios::where('usuario_id', auth()->user()->id)->get();
        return view('productos.create', compact('negocios'));
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image',
            'costo' => 'required|numeric',
            'negocio_id' => 'required|exists:negocios,id'
        ]);

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('producto_') . '.png';
            if(!is_dir(public_path('/imagenes/productos/'))){
                File::makeDirectory(public_path() . '/imagenes/productos/', 0777, true);
            }
            $imagen->move(public_path().'/imagenes/productos/', $nombreImagen);
        } else {
            $nombreImagen = 'default.png';
        }

        $producto = new Productos();
        $producto->nombre = $request->nombre;
        $producto->imagen = $nombreImagen;
        $producto->descripcion = $request->descripcion;
        $producto->costo = $request->costo;
        $producto->estado = true;
        $producto->negocio_id = auth()->user()->id;
        if ($producto->save()) {
            return redirect('/productos')->with('success', 'Registro agregado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué realizado!');
        }
    }

    public function edit($id){
        $producto = Productos::find($id);
        $negocios = Negocios::where('usuario_id', auth()->user()->id)->get();
        return view('productos.edit', compact('producto', 'negocios'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'image',
            'costo' => 'required|numeric',
            'negocio_id' => 'required|exists:negocios,id'
        ]);

        $producto = Productos::find($id);
        if($request->hasFile('imagen')){
            // Eliminar imagen anterior
            if($producto->imagen != 'default.png'){
                if(file_exists(public_path('imagenes/productos/'.$producto->imagen))){
                    unlink(public_path('imagenes/productos/'.$producto->imagen));
                }
            }

            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('producto_') . '.png';
            if(!is_dir(public_path('/imagenes/productos/'))){
                File::makeDirectory(public_path() . '/imagenes/productos/', 0777, true);
            }
            $imagen->move(public_path().'/imagenes/productos/', $nombreImagen);
            $producto->imagen = $nombreImagen;
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->costo = $request->costo;
        $producto->estado = true;
        $producto->negocio_id = $request->negocio_id;
        if ($producto->save()) {
            return redirect('/productos')->with('success', 'Registro actualizado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué actualizado!');
        }
    }

    // estado
    public function estado($id){
        $producto = Productos::find($id);
        $producto->estado = !$producto->estado;
        if ($producto->save()) {
            return redirect('/productos')->with('success', 'Estado actualizado correctamente!');
        } else {
            return back()->with('error', 'El estado no fué actualizado!');
        }
    }
}
