<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\preflight;



//use App\Http\Controllers\AlumnoController; //used for new way

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


  //TO RUN LOCALLY: php -S localhost:8000 -t public/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clear-cache', function() {
    
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
  });
  Route::get('/clear-cache2', function() {
    
    $exitCode = Artisan::call('route:clear');
    return 'DONE2'; //Return anything
  });



  Route::post('Login', 'AuthController@loginnohash')-> middleware('pref');
  

  Route::get('preregistroTEST','PreregistroController@showfirst');



Route::post('preregistro','PreregistroController@store');


  Route::group(['middleware' =>['pref' ]], function(){ //'tokenmiddle'


  //Route::get('Login', 'AuthController@login');
  Route::post('Logout', 'AuthController@logout');
 
  Route::post('Registro', 'AuthController@register');//-> middleware('pref');
  Route::post('RegistroA', 'AuthController@registerA');//-> middleware('pref');
  Route::post('RegistroP', 'AuthController@registerP');//-> middleware('pref');






  //Route::get('Alumno',[AlumnoController::class,'showall']); //need to use if not remove in roterserviceprovider comment on  protected $namespace = 'App\Http\Controllers';
  Route::get('alumno/','AlumnoController@showall');
  Route::get('alumno/{id}','AlumnoController@show');
  Route::post('alumno','AlumnoController@store');
  Route::patch('alumno/{id}','AlumnoController@update');
  Route::delete('alumno/{id}','AlumnoController@destroy');




  Route::get('maestro/','ProfesorController@showall');
  Route::get('maestro/{id}','ProfesorController@show');
  Route::post('maestro','ProfesorController@store');
  Route::patch('maestro/{id}','ProfesorController@update');
  Route::delete('maestro/{id}','ProfesorController@destroy');


  Route::get('curso/','CursoController@showall');
  Route::get('curso/{id}','CursoController@show');
  Route::post('curso','CursoController@store');
  Route::patch('curso/{id}','CursoController@update');
  Route::delete('curso/{id}','CursoController@destroy');

  Route::get('curso/maestro/{id}','CursoController@showdemaestro');


  Route::get('inscrito/','InscritoController@showall');
  Route::get('inscrito/{id}','InscritoController@show');
  Route::post('inscrito','InscritoController@store');
  Route::patch('inscrito/{id}','InscritoController@update');
  Route::delete('inscrito/{id}','InscritoController@destroy');

  Route::get('inscrito/alumno/{id}','InscritoController@showdealumno');
  Route::get('inscrito/maestro/{id}/{idc}','InscritoController@showdemaestro');

  Route::get('preregistro','PreregistroController@showall');
  Route::get('PreRegistro/{id}','PreregistroController@show');
  
  });//end of preflight