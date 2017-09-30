<?php

namespace App\Http\Controllers;

use Redirect;
use Validator;
use Session;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

class EquipoController extends BaseController
{
    protected $repositorio_personas;

    public function __construct(PersonaInterface $repositorio_personas)
    {
        $this->repositorio_personas = $repositorio_personas;
    }


    public function insertar(Request $request)
    {
        $validator = $this->validateForm($request);
        $modalidad_valida = $this->validateModalidad($request);   

        if ($validator->fails() || !$modalidad_valida) 
        { 
            if (!$modalidad_valida) $validator->errors()->add('Limite modalidad', 'Ya se supero el limite máximo de equipos registrados para modalidad.');
            return redirect('/welcome')
                        ->withErrors($validator)
                        ->withInput()
                        ->with(['status' => 'error']);
        } else {

            $cuenta = Equipo::where('nombre_equipo','like',$request->nombre)->count();
            if($cuenta>0)
            {   
                $validator->errors()->add('Limite modalidad','el nombre de equipo ya fue asignado');
                $enc = url_segura('encapsular', $request->input('id'));
                return redirect('/welcome')
                            ->withErrors($validator)
                            ->withInput()
                            ->with(['status' => 'error']);
            }

            $limites = Categoria_deporte::with('deporte')->find($request->id_categoria_deporte);
            $limite = $limites->deporte['limite'];
            $actual_equipos_cat =  DB::table('categoria_limite')->get();
           
/*
            if($actual_equipos_cat[0]->total >$limite)
            {   
                $validator->errors()->add('cantidad de equipos superado en esta categoria');
                $enc = url_segura('encapsular', $request->input('id'));
                return redirect('/welcome')
                            ->withErrors($validator)
                            ->withInput()
                            ->with(['status' => 'error']);
            } */
        
            $equipo = new Equipo([]);
            $equipo = $this->store($equipo, $request);

             Mail::send('email2', ['user' => $request->input('email'),'equipo' => $equipo,'link'=> 'https://www.idrd.gov.co/SIM/Festival_ED/welcome/'.url_segura('encapsular',$equipo['id'])], function ($m) use ($request)  {
                $m->from('no-reply@idrd.gov.co', 'Registro incompleto Festivales escuelas haga click para continuar inscripción');
                $m->to($request->input('email'), $request->input('nombre'))->subject('Registro incompleto!');
            });

            return redirect('/welcome/'.url_segura('encapsular',$equipo['id']))
                        ->with(['status' => 'success']);
        }
    }

    public function update(Request $request, $id_equipo = null)
    {   
        $desc = url_segura('desencapsular', $id_equipo);
        $formulario = empty($id_equipo) ? null : Equipo::with('personas', 'personas.tipoDocumento')->find($desc) ;
        $data = [
            'seccion' => 'Formulario',
            'titulo' => 'Formulario',
            'localidades' => Localidad::all(),
            'Categoria_deporte' => Categoria_deporte::with('deporte','categoria')->get(),
            'documentos' => Documento::all(),
            'etnias' => Etnia::all(),
            'status' => session('status'),
            'formulario' => $formulario
        ];

        return view('welcome', $data);
    }

    public function editar(Request $request)
    {

        $validator = $this->validateForm($request);
        $modalidad_valida = $this->validateModalidad($request);   
        $mujeres =  DB::table('inscritos_info')->where(['id_genero'=>2,'id_equipo'=>$request->input('id')])->count();
        $hombres =  DB::table('inscritos_info')->where(['id_genero'=>1,'id_equipo'=>$request->input('id')])->count();
        $limites = Equipo::with('categoria_deporte.categoria','categoria_deporte.deporte')->find($request->input('id'));
        $limite = $limites->categoria_deporte->deporte['limite'];
        $minimo_jugadores = $limites->categoria_deporte->deporte['minimo_jugadores'];
        $maximo_jugadores = $limites->categoria_deporte->deporte['maximo_jugadores'];
        $minimo_sexo = $limites->categoria_deporte->deporte['minimo_sexo'];

        if(($mujeres+$hombres) < $minimo_jugadores){

           $validator->errors()->add('Participantes','El minimo de participante es '.$minimo_jugadores);
            $enc = url_segura('encapsular', $request->input('id'));
            return redirect('/welcome/'.$enc)
                        ->withErrors($validator)
                        ->withInput()
                        ->with(['status' => 'error']);
        }

        if(($mujeres+$hombres) > $maximo_jugadores){

            $validator->errors()->add('Participantes','Limite de participante superado');
            $enc = url_segura('encapsular', $request->input('id'));
            return redirect('/welcome/'.$enc)
                        ->withErrors($validator)
                        ->withInput()
                        ->with(['status' => 'error']);
        }
              
        $equipo = Equipo::find($request->input('id'));
       
        $this->store($equipo, $request);
        $enc = url_segura('encapsular', $request->input('id'));
        Mail::send('email', ['user' => $request->input('email'),'equipo' => $equipo], function ($m) use ($request)  {
            $m->from('no-reply@idrd.gov.co', 'Registro Exitoso Festival escuelas deportivas');
            $m->to($request->input('email'), $request->input('nombre'))->subject('Registro Exitoso Festival escuelas deportivas!');
        });
        $equipo->estado = 1;
        $equipo->save();
       // return redirect('/welcome/')->with(['status' => 'complete']);
         return redirect('/welcome/'.url_segura('encapsular',$request->input('id')))
                        ->with(['status' => 'success']);
    }

    public function reporte(){
         $participantes =  DB::table('reporte_inscritos')->get();
         return view('reporte_general',['participantes'=>$participantes]);      
    }

      public function reporte_equipos(){
         $participantes =  DB::table('reporte_equipos')->get();
         return view('reporte_equipos',['participantes'=>$participantes]);      
    }


    public function procesarPersona(Request $request)
    {

        $mujeres =  DB::table('inscritos_info')->where(['id_genero'=>2,'id_equipo'=>$request->input('id')])->count();
        $hombres =  DB::table('inscritos_info')->where(['id_genero'=>1,'id_equipo'=>$request->input('id')])->count();
        $validator = $this->validatePersona($request);
        if ($validator->fails())
            return response()->json(['estado' =>false, 'errors' => $validator->errors()]);

        $tipo =  Equipo::select('id_categoria_deporte')->find($request->input('id'));
        if($tipo->id_categoria_deporte==9 && intval($request->Id_Genero) !=1){
            return response()->json(['estado' => 'repetido', 'errors' => 'El participante no tiene el genero nesesario para esta categoria']);
        }

        if($tipo->id_categoria_deporte==10 &&  intval($request->Id_Genero) !=2){
            return response()->json(['estado' => 'repetido', 'errors' => 'La participante no tiene el genero nesesario para esta categoria']);
        }


        $limites = Equipo::with('categoria_deporte.categoria','categoria_deporte.deporte')->find($request->id);
        $limite = $limites->categoria_deporte->deporte['limite'];
        $minimo_jugadores = $limites->categoria_deporte->deporte['minimo_jugadores'];
        $maximo_jugadores = $limites->categoria_deporte->deporte['maximo_jugadores'];
       // $minimo_sexo = $limites->categoria_deporte->deporte['minimo_sexo'];

        

            $categoria = $limites->categoria_deporte['id_categoria'];
            $edad_h = Carbon::createFromFormat('Y-m-d',$request->Fecha_Nacimiento)->age;
            if($categoria==1 && ($edad_h <11 || $edad_h >12)){
                return response()->json(['estado' => 'repetido', 'errors' => 'El participante no cumple con la edad para esta categoria solo tiene: '.$edad_h.' años']);
            }
            if($categoria==2 && ($edad_h <11 || $edad_h >12)){
                return response()->json(['estado' => 'repetido', 'errors' => 'El participante no cumple con la edad para esta categoria solo tiene: '.$edad_h.' años']);
            }
            if($categoria==3 && ($edad_h <11 || $edad_h >13)){
                return response()->json(['estado' => 'repetido', 'errors' => 'El participante no cumple con la edad para esta categoria solo tiene: '.$edad_h.' años']);
            }
            
            if($categoria==1 && $hombres >= $maximo_jugadores){
                return response()->json(['estado' => 'repetido', 'errors' => 'Limite de participante superado']);
            }
            if($categoria==2 && $mujeres >= $maximo_jugadores){
                return response()->json(['estado' => 'repetido', 'errors' => 'Limite de participante superado']);
            }
            if($categoria==3 && $mujeres >= $maximo_jugadores){
                return response()->json(['estado' => 'repetido', 'errors' => 'Limite de participante superado']);
            }

        /*
        if(($mujeres+$hombres) >= $maximo_jugadores){
           
             return response()->json(['estado' => 'repetido', 'errors' => 'Limite de participante superado']);
        }*/


        if ($request->input('Id_Persona') == 0 ) $persona = $this->repositorio_personas->guardar($request->input());
        else
            $persona = $this->repositorio_personas->actualizar($request->input());
            $equipos = Equipo::whereHas('personas', function($query) use ($persona){
               return $query->where('persona.Id_Persona', $persona['Id_Persona']);
            })->lists('id');
                            
        if(count($equipos->toArray()) > 0 && !in_array($request->input('id_equipo'), $equipos->toArray()))
           return response()->json(['estado' => 'repetido', 'errors' => 'Participante repetido']);

        $equipo = Equipo::with('personas')->find($request->input('id_equipo'));
        $to_sync = [];

        foreach ($equipo->personas as &$miembro)
        {
            if($miembro->Id_Persona != $persona->Id_Persona)
            {
                $to_sync[$miembro->Id_Persona] = [
                    'talla' => $miembro->pivot['talla'],
                    'rh' => $miembro->pivot['rh'],
                    'digital_documento' => $miembro->pivot['digital_documento'],
                    'digital_eps' => $miembro->pivot['digital_eps'],
                ];
            }else{
                $persona_anterior = $miembro;
            }
        }

            if ($request->hasFile('documento_de_entidad'))
        {
            if ($request->file('documento_de_entidad')->isValid()) 
            {
                $destinationPath = 'public/Uploads'; 
                $extension = $request->file('documento_de_entidad')->getClientOriginalExtension(); 
                $fileName = date('yy-mm-dd').rand(11111,99999).'.'.$extension; 
                $request->file('documento_de_entidad')->move($destinationPath, $fileName); 
                $url_documento_de_entidad = $fileName;
            }
        } else {
            $url_documento_de_entidad = "";
        }
        
        // carga de archivo 2
        if ($request->hasFile('afiliacion_eps'))
        {
            if ($request->file('afiliacion_eps')->isValid()) 
            {
                $destinationPath = 'public/Uploads'; 
                $extension = $request->file('afiliacion_eps')->getClientOriginalExtension(); 
                $fileName = date('yy-mm-dd').rand(11111,99999).'.'.$extension; 
                $request->file('afiliacion_eps')->move($destinationPath, $fileName); 
                $url_afiliacion_eps = $fileName;
            }
        } else {
            $url_afiliacion_eps = "";
        }
        
        // carga de archivo 3
        if ($request->hasFile('fotografia'))
        {
            if ($request->file('fotografia')->isValid()) 
            {
                $destinationPath = 'public/Uploads'; 
                $extension = $request->file('fotografia')->getClientOriginalExtension(); 
                $fileName = date('yy-mm-dd').rand(11111,99999).'.'.$extension; 
                $request->file('fotografia')->move($destinationPath, $fileName); 
                $url_fotografia = $fileName;
            }
        } else {
            $url_fotografia = "";
        }


        $doc= empty($url_documento_de_entidad)? $persona_anterior->pivot['digital_documento']:$url_documento_de_entidad;
        $eps= empty($url_afiliacion_eps)? $persona_anterior->pivot['digital_documento']:$url_afiliacion_eps;
       //  $foto=empty($url_fotografia)? $persona_anterior->pivot['fotografia']:$url_fotografia; 


        $to_sync[$persona->Id_Persona] = [
            'talla' => $request->input('Talla'),
            'telefono' => $request->input('telefono_participante'),
            'rh' => $request->input('rh'),
            'digital_documento' => $doc,
            'digital_eps' => $eps,
        ];

        $equipo->personas()->sync($to_sync);
        $equipo = Equipo::with('personas')->find($request->input('id_equipo'));
        return response()->json(['estado' => true, 'persona' => $equipo->personas]);
    }

    public function borrarPersona(Request $request)
    {
        $equipo = Equipo::with('personas')->find($request->input('id_equipo'));
        $to_sync = [];

        foreach ($equipo->personas as $miembro)
        {
            if($miembro->Id_Persona != $request->input('Id_Persona'))
            {
                $to_sync[$miembro->Id_Persona] = [
                    'telefono' => $miembro->pivot['telefono'],
                    'email' => $miembro->pivot['email'],
                    'rh' => $miembro->pivot['rh'],
                    'talla' => $miembro->pivot['talla'],
                    'digital_documento' => $miembro->pivot['digital_documento'],
                    'digital_eps' => $miembro->pivot['digital_eps'],
                ];
            }
        }

        $equipo->personas()->sync($to_sync);

        return response()->json(['estado' => true]);
    }

    public function borrarEquipo(Request $request)
    {
        $equipo = Equipo::with('personas')->find($request->input('id_equipo'));
        $equipo->personas()->detach();
        $equipo->delete();

        return redirect('/buscar')
                    ->with(['status' => 'success']);
    }

   	public function listar_categorias(Request $request)
   	{
   	  	$modalidad = Modalidad::with('categorias')->find($request->input('id_modalidad'));
		return response()->json($modalidad->categorias);
   	}

    public function listar_deportes(Request $request)
    {
        $deportes = Deporte::get();
        return response()->json($deportes);
    }


   	public function listar_modalidad(Request $request)
   	{
        $deporte = Deporte::with('modalidad')->find($request->input('id_deporte'));
        return response()->json($deporte->modalidad);
   	}

   	public function listar_localidad()
    {
	  	$lodalidades = Localidad::get();
   	  	return response()->json($lodalidades);
   	}

    public function listar_upz(Request $request)
    {
        $localidad = Localidad::with('upz')->find($request->input('id_localidad'));
        return response()->json($localidad->upz);
    }

   	public function listar_barrios(Request $request)
    {
   	  	
   	}

    private function validateForm($request)
    {
        $validator = Validator::make($request->all(),
            [
                'nombre' => 'required',
                'id_categoria_deporte' => 'required',
                'id_localidad' => 'required',
                'delegado' => 'required',
                'entrenador' => 'required',
                'asistente' => 'required',
                'email' => 'required',
                'telefono' => 'required',
                'certificado' => 'required_if:certificado_old,0|mimes:jpeg,bmp,png,pdf'
            ]
        );

        return $validator;
    }

    private function validateModalidad($request)
    {
        
        return true;
    }

    private function validatePersona($request)
    {
        $validator = Validator::make($request->all(),
            [
                'Id_TipoDocumento' => 'required|min:1',
                'Cedula' => 'required|numeric',
                'documento_de_entidad' => 'required',
                'afiliacion_eps' => 'required',
                'Primer_Apellido' => 'required',
                'Primer_Nombre' => 'required',
                'Fecha_Nacimiento' => 'required',
                'Id_Etnia' => 'required|min:1',
                'Id_Pais' => 'required|min:1',
                'Id_Genero' => 'required|in:1,2',
                'rh' => 'required',
                'Talla' => 'required'
            ]
        );

        return $validator;
    }

	private function store($equipo, $request)
    {
        $input = $request->input();
        $url = '';

        if ($request->hasFile('certificado'))
        {
            if ($request->file('certificado')->isValid())
            {
                $destinationPath = 'public/Uploads';
                $extension = $request->file('certificado')->getClientOriginalExtension();
                $fileName = date('yy-mm-dd').rand(11111,99999).'.'.$extension;
                $request->file('certificado')->move($destinationPath, $fileName);
                $url = $fileName;
            }
        } else {
            $url = $input['certificado_old'];
        }

		$equipo->nombre_equipo = $input['nombre'];
		$equipo->id_categoria_deporte = $input['id_categoria_deporte'];
		$equipo->entrenador = $input['entrenador'];
		$equipo->asistente = $input['asistente'];
		$equipo->id_localidad = $input['id_localidad'];
		/*$equipo->id_upz = $input['id_upz'];
		$equipo->id_barrio = $input['id_barrio'];*/
		$equipo->delegado = $input['delegado'];
		$equipo->email = $input['email'];
		$equipo->telefono = $input['telefono'];
		$equipo->direccion = $input['direccion'];
        $equipo->pdf = $url ;
        $equipo->save();
        return $equipo;
    }
}
