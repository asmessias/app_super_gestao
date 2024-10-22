<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos() {
        //Implementação com tabelas padronizadas.
        //return $this->belongsToMany('App\Produto', 'pedidos_produtos');

        //Implemetação com tabelas não padronizadas.
        return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('created_at', 'quantidade');
    }
}
