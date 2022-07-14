<?php

use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\throwException;

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
$regiones= DB::table('regiones')->paginate(5);
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
Route::post('/region/update',function(){
    $regNombre=request()->regNombre;
    $idRegion=request()->idRegion;

    try{
    DB::table('regiones')->where('idRegion',$idRegion)->update(['regNombre'=>$regNombre]);

    return redirect('/regiones')->with(['mensaje' => 'Región modificada correctamente']);
}
catch(Throwable $th){
    return redirect('/regiones')->with(['mensaje'=>'No se pudo modificar']);
    }
});

Route::get('/region/delete/{id}', function($id){
    $region=DB::table('regiones')->where('idRegion',$id)->first();

    $cantidad=DB::table('destinos')->where('idRegion',$id)->count();

    return view('regionDelete',
    [
        'region'=>$region,
        'cantidad'=>$cantidad
    ]);
});

Route::post('/region/destroy',function(){

    $regNombre=request()->regNombre;
    $idRegion=request()->idRegion;
    try{
    DB::table('regiones')->where('idRegion',$idRegion)->delete();
    return redirect('/regiones')->with(['mensaje' => 'Región '.$regNombre.'Eliminada correctamente']);
    }
    catch(Throwable $th){
        return redirect('/regiones')->with(['mensaje' => 'Región No se puede eliminar']);
    }
});
Route::get('/destinos', function () {
    //obtenemos listado de regiones
    // $destinos = DB::table('destinos')->get();
    $destinos = DB::table('destinos as d')
                    ->join('regiones as r','r.idRegion','=','d.idRegion')
                    ->paginate(5);
    //Pasamos datos a la vista

    return view('destinos',
     ['destinos' => $destinos,

        ]);
});
Route::get('/destino/create', function () {
    $regiones=DB::table('regiones')->paginate(5);

    return view('destinoCreate',['regiones'=>$regiones]);
});
Route::post('/destino/store', function () {
    $destNombre = request()->destNombre;
    $idRegion = request()->idRegion;
    $destPrecio = request()->destPrecio;
    $destAsientos = request()->destAsientos;
    $destDisponibles = request()->destDisponibles;


    DB::table('destinos')->insert(
        ['destNombre'=>$destNombre,
         'idRegion'=>$idRegion,
         'destPrecio'=>$destPrecio,
         'destAsientos'=>$destAsientos,
         'destDisponibles'=>$destDisponibles
        ]);
        return redirect('/destinos')->with(['mensaje'=>'Destino:'.$destNombre.' Agregado Correctamente']);
});
Route::get('/destino/edit/{id}', function ($id) {
    $destino = DB::table('destinos')
        ->where('idDestino', $id)
        ->first();

    $regiones = DB::table('regiones')
        ->get();

    return view(
        'destinoEdit',
        [
            'regiones' => $regiones,
            'destino' => $destino
        ]
    );
});
Route::post('/destino/update', function ()
{
    $request = [
        "destNombre" => request()->destNombre,
        "idRegion" => request()->idRegion,
        "destPrecio" => request()->destPrecio,
        "destAsientos" => request()->destAsientos,
        "destDisponibles" => request()->destDisponibles
    ];

    try {
        DB::table('destinos')
            ->where('idDestino', request()->idDestino)
            ->update($request);
        return redirect('/destinos')
            ->with(['mensaje' => 'Destino: '.request()->destNombre.' modificado correctamente']);
    } catch (\Throwable $th)
    {
        //throw $th;
        return redirect('/destinos')->with(['mensaje' => 'No se pudo modificar el destino.']);
    }
});

Route::get('/destino/delete/{id}',function($id)
{
$destino=  DB::table('destinos')->where('idDestino',$id)->first();
}
);
