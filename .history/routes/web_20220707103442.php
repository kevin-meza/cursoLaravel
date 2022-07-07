<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function () {
    return view('hola');
});

Route::get('/form', function () {
    return view('form');
});
Route::post('/procesa', function () {
    $nombre=request()->input('nombre');
$users=['Admin','Supervisor','Operador','Invitado'];
    return view('procesa',
            [
                'nombre'=>$nombre,
                'users'=>$users
            ]);
});
// Route::get('/param/{z}/{y}', function ($nombre ,$numero) {
//     return 'Nombre:'.$nombre.' N°=:'.$numero;
// });
//desde la plantilla nueva ruta

Route::get('/inicio', function () {
    return view('inicio');
});
###crud de regiones#####

Route::get('/regiones',function(){

// $regiones = DB::select('SELECT idRegion,regNombre FROM regiones');
$regiones= DB::table('regiones')->get();
return view('regiones',
            [
                'regiones'=>$regiones,

            ]);
});
Route::get('/region/create', function () {
    return view('regionCreate');
});
Route::post('/region/store', function () {
    //permite validar mas facil
    $regNombre= request()->regNombre;
    // DB::insert('INSERT INTO regiones (regNombre) VALUES (:regNombre)',[$regNombre]);
 DB::table('regiones')->insert(['regNombre'=>$regNombre]);
return redirect('/regiones')->with(['mensaje'=>'Region: '.$regNombre.' Agregada Correctamente']);
});
Route::get('/region/update', function () {
    return view('regionEdit');
});

Route::get('/region/edit/{id}',function($id){
   // $region=DB::select('SELECT idRegion,regNombre from regiones where idRegion = :idRegion', [$id]);
   $region=DB::table('regiones')->where('idRegion',$id)->first();
   return view('regionEdit',['region'=>$region]);
});
Route::post('/region/update');
