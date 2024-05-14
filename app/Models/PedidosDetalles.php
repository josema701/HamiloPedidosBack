<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosDetalles extends Model
{
    use HasFactory;

    protected $table = 'pedidos_detalles';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'costo',
    ];

    // RELACION CON PEDIDOS
    public function pedido(){
        return $this->belongsTo(Pedidos::class, 'pedido_id');
    }

    // RELACION CON PRODUCTOS
    public function producto(){
        return $this->belongsTo(Productos::class, 'producto_id');
    }

}
