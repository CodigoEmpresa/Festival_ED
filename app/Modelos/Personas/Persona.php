<?php

namespace App\Modelos\Personas;

use Idrd\Usuarios\Repo\Persona as MPersona;

class Persona extends MPersona
{
   	public function equipos()
    {
        return $this->belongsToMany('App\Modelos\Formulario\Equipo', config('database.connections.mysql.database').'.inscritos', 'id_persona', 'id_equipo')
                        ->withPivot('rh', 'digital_documento', 'digital_eps','telefono','fotografia','email');
    }
}
