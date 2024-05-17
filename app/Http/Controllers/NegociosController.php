<?php

namespace App\Http\Controllers;

use App\Models\Negocios;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NegociosController extends Controller
{
    public function index(){
        $arrayNeg = Negocios::where('usuario_id', auth()->user()->id)->get()->pluck('id');

        $negocios = Negocios::whereIn('id', $arrayNeg)->orderBy('id', 'desc')->paginate(10);

        return view('negocios.index', compact('negocios'));
    }

    public function create(){
        return view('negocios.create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|unique:negocios,nombre',
            'descripcion' => 'required',
            'imagen' => 'required|image'
        ]);

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('negocio_') . '.png';
            if(!is_dir(public_path('/imagenes/negocios/'))){
                File::makeDirectory(public_path() . '/imagenes/negocios/', 0777, true);
            }
            $imagen->move(public_path().'/imagenes/negocios/', $nombreImagen);
        } else {
            $nombreImagen = 'default.png';
        }

        $negocio = new Negocios();
        $negocio->nombre = $request->nombre;
        $negocio->imagen = $nombreImagen;
        $negocio->descripcion = $request->descripcion;
        $negocio->estado = true;
        $negocio->usuario_id = auth()->user()->id;
        if ($negocio->save()) {
            return redirect('/negocios')->with('success', 'Registro agregado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué realizado!');
        }
    }

    public function edit($id){
        $negocio = Negocios::find($id);
        return view('negocios.edit', compact('negocio'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required|unique:negocios,nombre,'.$id,
            'descripcion' => 'required',
            'imagen' => 'image'
        ]);

        $negocio = Negocios::find($id);
        $nombreImagen = $negocio->imagen;
        if($request->hasFile('imagen')){
            // Eliminar imagen anterior
            if($negocio->imagen != 'default.png'){
                if(file_exists(public_path('/imagenes/negocios/'.$negocio->imagen))){
                    unlink(public_path('/imagenes/negocios/'.$negocio->imagen));
                }
            }

            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('negocio_') . 'png';
            if(!is_dir(public_path('/imagenes/negocios/'))){
                File::makeDirectory(public_path() . '/imagenes/negocios/', 0777, true);
            }
            $imagen->move(public_path().'/imagenes/negocios/', $nombreImagen);
        }

        $negocio->nombre = $request->nombre;
        $negocio->imagen = $nombreImagen;
        $negocio->descripcion = $request->descripcion;
        $negocio->estado = true;
        $negocio->usuario_id = auth()->user()->id;
        if ($negocio->save()) {
            return redirect('/negocios')->with('success', 'Registro actualizado correctamente!');
        } else {
            return back()->with('error', 'El registro no fué actualizado!');
        }
    }

    // estado
    public function estado($id){
        $negocio = Negocios::find($id);
        $negocio->estado = !$negocio->estado;
        if ($negocio->save()) {
            return redirect('/negocios')->with('success', 'Estado actualizado correctamente!');
        } else {
            return back()->with('error', 'El estado no fué actualizado!');
        }
    }

    // show
    public function show($id){
        $negocio = Negocios::find($id);

        $productos = Productos::where('negocio_id', $id)->orderBy('id', 'DESC')->paginate(10);

        return view('negocios.show', compact('negocio', 'productos'));
    }
}
