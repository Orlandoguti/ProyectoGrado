
<?php
use App\Persona;
use App\Rfid;
use App\Http\Controllers\MailController;
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
Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/', 'Auth\LoginController@login')->name('login');
});



Route::group(['middleware'=>['auth']],function(){

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/main', function () {return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Administrador']], function () {

        Route::post('/lista/store', 'ListaController@store');
        Route::get('/listagrupo1', 'ListaController@listagrupo1');
        Route::get('/listaProceso1', 'ListaController@listaProceso1');
        Route::get('/listaVerificar', 'RfidController@listaVerificar');
        Route::get('/genero/selectGenero', 'GeneroController@selectGenero');
        Route::get('/grupo/selectGrupo', 'GrupoController@selectGrupo');

        Route::get('/persona/selectPersona', 'PersonaController@selectPersona');
        Route::get('/personas/ver/{id}','PersonaController@autollenarPersona');

        Route::get('/rfid/index', 'RfidController@index');
        Route::get('/rfid/indexAdministrador', 'RfidController@indexAdministrador');
        Route::post('/rfid/ver','RfidController@autollenarRfid');
        Route::post('/rfid/registrar', 'RfidController@store');
        Route::get('/rfid/verificar', 'RfidController@verificar');
        Route::post('/rfid/proceso1', 'RfidController@Proceso1');
        Route::post('/rfid/actualizarIdGeneroLista', 'RfidController@actualizarIdGeneroLista');
        Route::delete('/rfid/eliminar/{id}', 'RfidController@eliminar');
        Route::post('/rfid/pdf', 'RfidController@pdf')->name('pdf.generate');
        Route::get('/rfid/excel', 'RfidController@excel')->name('excel.generate');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');

        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::post('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');

        Route::get('/cargo/selectCargo', 'CargoController@selectCargo');



    });
    Route::group(['middleware' => ['Trabajador']], function () {

        Route::get('/listaProceso1', 'ListaController@listaProceso1');
        Route::get('/listaVerificar', 'RfidController@listaVerificar');
        Route::get('/genero/selectGenero', 'GeneroController@selectGenero');
        Route::get('/grupo/selectGrupo', 'GrupoController@selectGrupo');

        Route::get('/rfid/index', 'RfidController@index');
        Route::post('/rfid/ver','RfidController@autollenarRfid');
        Route::post('/rfid/registrar', 'RfidController@store');
        Route::get('/rfid/verificar', 'RfidController@verificar');
        Route::post('/rfid/proceso1', 'RfidController@Proceso1');
        Route::post('/rfid/actualizarIdGeneroLista', 'RfidController@actualizarIdGeneroLista');
        Route::delete('/rfid/eliminar/{id}', 'RfidController@eliminar');

        Route::get('/persona/selectPersona', 'PersonaController@selectPersona');
        Route::get('/personas/ver/{id}','PersonaController@autollenarPersona');


    });

    Route::group(['middleware' => ['Afiliado']], function () {


    });


});

