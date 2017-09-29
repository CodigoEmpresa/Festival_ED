<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Modelos\Parques\Localidad;
use App\Modelos\Parques\Upz;
use App\Modelos\Formulario\Categoria;
use App\Modelos\Formulario\Categoria_deporte;
use App\Modelos\Formulario\Deporte;
use App\Modelos\Formulario\Modalidad;
use App\Modelos\Formulario\Equipo;
use App\Modelos\Personas\Persona;
use App\Modelos\Personas\Documento;
use App\Modelos\Personas\Etnia;
use Idrd\Usuarios\Repo\PersonaInterface;
use Carbon\Carbon;

class LimpiarEquipos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'limpiar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        date_default_timezone_set('America/Bogota');

        $no_validos = Equipo::with('personas')->where(['estado' => 0])->get();
         foreach($no_validos as $equipo)
        {   
            $Fecha_creacion = $equipo->create_update;

            $now = Carbon::now();

            $date = date('Y-d-m h:i:s');

            $end_date = Carbon::parse($Fecha_creacion);

            $lengthOfAd = $end_date->diffInHours($now);

            echo $date.' '.$now.' '.$Fecha_creacion.' '.$lengthOfAd;
            if($lengthOfAd>24){
                $equipo->personas()->detach();
                $equipo->delete();
            }
        }
       
       
    }
}
