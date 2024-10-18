<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuturoJubiladoController;
use App\Http\Controllers\PersonaController;
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
    return view('welcome2');
});

require __DIR__.'/auth.php';

Route::get('/jubilaciones','App\Http\Controllers\M4dashboardController@jubilaciones') ->name('jubilaciones');

//Route::get('/dashboard/{usuario_name?}','App\Http\Controllers\M4dashboardController@dashboard') ->name('dashboard');

Route::get('/planta','App\Http\Controllers\M4dashboardController@planta') ->name('planta');

Route::get('/ausentismo','App\Http\Controllers\M4dashboardController@ausentismo') ->name('ausentismo');
Route::get('/sindicatos','App\Http\Controllers\M4dashboardController@sindicatos') ->name('sindicatos');
Route::get('/licencias','App\Http\Controllers\M4dashboardController@licencias') ->name('licencias');

Route::get('/ShowAltasAgrupadas/{periodo?}', 'App\Http\Controllers\M4dashboardController@ShowAltasAgrupadas')->name('ShowAltasAgrupadas');
Route::get('/ShowAltas/{periodo?}', 'App\Http\Controllers\M4dashboardController@ShowAltas')->name('ShowAltas');

Route::get('/auth/callback', 'App\Http\Controllers\AuthController@handleCallback')->name('auth.callback');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::get('/dashboard','App\Http\Controllers\M4dashboardController@dashboard') ->name('dashboard');
Route::get('/','App\Http\Controllers\M4dashboardController@dashboard') ->name('dashboard');     

Route::get('/planta/{nickname?}','App\Http\Controllers\M4dashboardController@planta') ->name('planta');

Route::get('/busca_personas','App\Http\Controllers\M4dashboardController@personas') ->name('busca_personas');

Route::get('/jubilaciones','App\Http\Controllers\M4dashboardController@jubilaciones') ->name('jubilaciones');
Route::get('/ausentismo','App\Http\Controllers\M4dashboardController@ausentismo') ->name('ausentismo');
Route::get('/sindicatos','App\Http\Controllers\M4dashboardController@sindicatos') ->name('sindicatos');
Route::get('/licencias','App\Http\Controllers\M4dashboardController@licencias') ->name('licencias');

Route::get('/ShowAltasAgrupadas/{periodo?}', 'App\Http\Controllers\M4dashboardController@ShowAltasAgrupadas')->name('ShowAltasAgrupadas');
Route::get('/ShowAltas/{periodo?}', 'App\Http\Controllers\M4dashboardController@ShowAltas')->name('ShowAltas');

Route::get('uor','App\Http\Controllers\M4dashboardController@uor');
Route::post('/buscador_gde','App\Http\Controllers\M4dashboardController@buscador_gde')->name('buscador_gde');


Route::resource('futurojubilado', FuturoJubiladoController::class);



// Ruta para el método create_from_json
Route::get('/futurosjubilados/create_from_json', [FuturoJubiladoController::class, 'create_from_json']);
// use App\Http\Controllers\FuturoJubiladoController;

Route::get('/futurosjubilados', [FuturoJubiladoController::class, 'index'])->name('futurosjubilados.index');

Route::post('/futurosjubilados/store', [FuturoJubiladoController::class, 'store'])->name('futurosjubilados.store');
Route::post('/futurosjubilados/show', [FuturoJubiladoController::class, 'show'])->name('futurosjubilados.show');

Route::resource('personas', PersonaController::class);


Route::get('/futurojubilados/seguimientoUsuarios/{usuario?}', [FuturoJubiladoController::class, 'seguimientoUsuarios'])
    ->name('futurojubilados.seguimientoUsuarios');

Route::get('/futurojubilados/bajas', [FuturoJubiladoController::class, 'bajas'])
    ->name('bajas.index');

 

Route::post('personas/guardar-seguimiento', [PersonaController::class, 'guardarSeguimiento'])
        ->name('personas.guardarSeguimiento');
    
use App\Http\Controllers\MailController;

Route::get('/enviar-correo-oficial', [MailController::class, 'sendOfficialEmail']);
        
        