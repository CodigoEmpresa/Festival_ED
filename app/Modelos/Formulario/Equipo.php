<?php

namespace App\Modelos\Formulario;

use Illuminate\Database\Eloquent\Model;
use Idrd\Usuarios\Seguridad\TraitSeguridad;

class Equipo extends Model
{
    protected $table = 'equipo';
    public $timestamps = false;
    

    public function modalidad()
    {
        return $this->belongsTo('App\Modelos\Formulario\Modalidad','id_modalidad');
    }

    public function categoria_deporte()
    {
        
         return $this->belongsTo('App\Modelos\Formulario\Categoria_deporte','id_categoria_deporte','id_categoria_deporte');
    }

    public function localidad()
    {
        return $this->belongsTo('App\Modelos\Parques\Localidad','id_localidad');
    }

    public function upz()
    {
        return $this->belongsTo('App\Modelos\Parques\Upz','id_upz');
    }

    public function personas()
    {
        return $this->belongsToMany('App\Modelos\Personas\Persona', config('database.connections.mysql.database').'.inscritos', 'id_equipo', 'id_persona')
                        ->withPivot('rh', 'digital_documento', 'digital_eps','fotografia','telefono','email','talla');
    }
    use TraitSeguridad;
}

