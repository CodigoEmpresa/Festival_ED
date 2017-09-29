<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB as DB;
use App\Http\Requests;
use Validator;
use Session;
use PDF;
use App\Modelos\Formulario\Equipo;
use App\Modelos\Personas\Persona;

class PdfController extends BaseController {

    public function carnet(Request $request)
    {
      $equipo = Equipo::with(['personas' => function($query) use ($request) {
        return $query->find($request->input('Id_Persona'));
      }])->find($request->input('id_equipo'));
      $edad = $this->calcular($equipo->personas[0]['Fecha_Nacimiento']);
       if (empty($equipo)) { return view('error',['error' => 'No existe este usuario'] ); exit(); }
         $view =  view('carnet', 
          ['nombres' => $equipo->personas[0]['Primer_Nombre'].' '.$equipo->personas[0]['Segundo_Nombre'],
          'apellidos' => $equipo->personas[0]['Primer_Apellido'].' '.$equipo->personas[0]['Segundo_Apellido'],
          'cedula' => $equipo->personas[0]['Cedula'],
          'barrio' => $equipo->id_barrio,
          'deporte' => $equipo->categoria_deporte->deporte['nombre'],
          'rh' => $equipo->personas[0]->pivot['rh'],
          'edad' =>$edad])->render();
         $pdf = PDF::loadHTML($view);
      return $pdf->setPaper('a6', 'portrait')->stream('Carnet '.date('l jS \of F Y h:i:s A'));     
    }

    public function carnet_equipo(Request $request, $id)
    {
      $desc = url_segura('desencapsular', $id);
      $equipo = Equipo::with('personas')->find($desc);
      if (empty($equipo)) { return view('error',['error' => 'No existe este usuario'] ); exit(); }
         $view =  view('carnet_equipo', ['equipo' => $equipo,'personas' => $equipo->personas])->render();
         /*return $view;
         exit();*/
         $pdf = PDF::loadHTML($view);
      return $pdf->setPaper('a6', 'portrait')->stream('Carnet '.date('l jS \of F Y h:i:s A'));     
    }
    
    private function calcular($fecha_nacimiento)
    {
        $date2 = date('Y-m-d');//
        $diff = abs(strtotime($date2) - strtotime($fecha_nacimiento));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return $years;
    }
    
}