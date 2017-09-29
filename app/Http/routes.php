<?php
session_start();
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');

//Route::any('/', 'MainController@index');

Route::any('/logout', 'MainController@logout');
Route::any('/carnet','PdfController@carnet');
Route::any('/carnet_equipo/{id}','PdfController@carnet_equipo');
Route::any('/', 'MainController@index');
Route::any('/limpiar_equipos', 'EquipoController@limpiar');
Route::any('/reporte', 'EquipoController@reporte');
Route::any('/reporte_equipos', 'EquipoController@reporte_equipos');

//rutas con filtro de autenticación
Route::group(['middleware' => ['web']], function () {

	Route::get('/buscar', 'MainController@buscar');
	//Route::get('/welcome', 'EquipoController@create');
	Route::get('/welcome/{id_equipo?}', 'EquipoController@update');
	Route::post('/welcome/insertar', 'EquipoController@insertar');
	Route::put('/welcome/editar', 'EquipoController@editar');
	Route::any('/welcome/persona/procesar', 'EquipoController@procesarPersona');
	Route::delete('/welcome/remover', 'EquipoController@borrarEquipo');
	Route::delete('/welcome/persona/remover', 'EquipoController@borrarPersona');

	Route::post('/listar_deportes', 'EquipoController@listar_deportes');
	Route::post('/listar_categorias', 'EquipoController@listar_categorias');
	Route::post('/listar_modalidad', 'EquipoController@listar_modalidad');
	Route::post('/listar_localidad', 'EquipoController@listar_localidad');
	Route::post('/listar_upz', 'EquipoController@listar_upz');
	Route::post('/listar_barrios', 'EquipoController@listar_barrios');
});
