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

Route::get('/inico',function(){
    return view('inicio');
});
