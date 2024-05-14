<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'negocio_id',
        'total',
        'fecha',
        'comentarios',
        'coordenadas',
        'estado',
    ];

    // RELACION CON CLIENTE: USERS
    public function cliente(){
        return $this->belongsTo(User::class, 'cliente_id');
    }

    // RELACION CON NEGOCIOS
    public function negocio(){
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }

    // RELACION CON PEDIDOS DETALLES
    public function detalles(){
        return $this->hasMany(PedidosDetalles::class, 'pedido_id');
    }

}
