<?php

namespace App\Modelos\Parques;

use Idrd\Parques\Repo\Localidad as MLocalidad;

class Localidad extends MLocalidad
{
    public function modalidades()
    {
        return $this->belongsToMany('App\Modelos\Formulario\Modalidad', config('database.connections.mysql.database').'.validacion', 'id_localidad', 'id_modalidad')->withPivot('cantidad');
    }
}
