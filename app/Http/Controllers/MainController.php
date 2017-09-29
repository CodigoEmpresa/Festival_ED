<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use App\Modelos\Parques\Localidad;
use App\Modelos\Formulario\Deporte;
use App\Modelos\Formulario\Equipo;
use App\Modelos\Personas\Persona;
use Illuminate\Http\Request;

class MainController extends Controller {

	protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

  	public function buscar()
  	{
	    if(empty($_SESSION['Usuario']))
			exit();
	   

		$data = [
			'seccion' => 'Busqueda',
			'titulo' => 'Busqueda equipos',
			'status' => session('status'),
			'equipos' => Equipo::with('Categoria_deporte','localidad','upz','personas')->get()
		];

		return view('buscar', $data);
	}


	

    public function index(Request $request)
	{
		 if ($request->has('vector_modulo'))
        {   
        	session_set_cookie_params(5000000000,"/");
            $vector = urldecode($request->input('vector_modulo'));
            $user_array = unserialize($vector);
            $_SESSION['Usuario'] = $user_array;
            $persona = Persona::find($_SESSION['Usuario'][0]);
            $_SESSION['Usuario']['Persona'] = $persona;
        } else {
            if(!isset($_SESSION['Usuario']))
                $_SESSION['Usuario'] = '';
           			 
        }
		return redirect('welcome/');
	}

	public function logout()
	{
		$_SESSION['Usuario'] = '';
		session('Usuario', '');

		return redirect()->to('../');
	}
}
