<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'negocio_id',
        'nombre',
        'imagen',
        'descripcion',
        'costo',
        'estado'
    ];

    // relacion con negocio
    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }

    // obtener la imagen
    public function getImagenUrl()
    {
        if($this->imagen && $this->imagen != 'default.png' && $this->imagen != null)
        {
            return asset('imagenes/productos/'.$this->imagen);
        } else {
            return asset('default.png');
        }
    }

}
