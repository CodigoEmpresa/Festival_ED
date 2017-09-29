<?php

return array( 
 
  'conexion' => 'db_principal', 
   
  'seccion' => 'Personas', 
  'prefijo_ruta' => 'personas', 
  'prefijo_ruta_modulo' => 'actividad', 
 
  'modelo_persona' => 'App\Modelos\Personas\Persona', 
  'modelo_documento' => 'App\Modelos\Personas\Documento', 
  'modelo_pais' => 'App\Modelos\Personas\Pais', 
  'modelo_ciudad' => 'App\Modelos\Personas\Ciudad', 
  'modelo_genero' => 'App\Modelos\Personas\Genero', 
  'modelo_etnia' => 'App\Modelos\Personas\Etnia', 
  'modelo_tipo' => 'Idrd\Usuarios\Repo\Tipo',
   
  //vistas que carga las vistas 
  'vista_lista' => 'list', 
 
  //lista 
  'lista'  => 'idrd.usuarios.lista', 
);