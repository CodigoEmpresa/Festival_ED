<?php

namespace App\Modelos\Formulario;

use Illuminate\Database\Eloquent\Model;

class Categoria_deporte extends Model
{
    protected $table = 'categoria_deporte';
    protected $primaryKey = 'id_categoria_deporte';
    public $timestamps = false;

     public function deporte()
    {
        
         return $this->belongsTo('App\Modelos\Formulario\Deporte','id_deporte');
    }


 	public function categoria()
    {
        
         return $this->belongsTo('App\Modelos\Formulario\Categoria','id_categoria');
    }


}
