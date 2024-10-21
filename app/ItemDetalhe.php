<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    protected $table = 'produto_detalhes';
    Protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

   public function item() {

      return $this->belongsTo('App\Item', 'produto_id', 'id');

  }
}
