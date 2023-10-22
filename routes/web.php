
<?php
use App\Persona;
use App\Rfid;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
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
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/', 'Auth\LoginController@login')->name('login');

});

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/main', function () {return view('contenido/contenido');
        })->name('main');
        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

       Route::group(['middleware' => ['Administrador']], function () {

        Route::post('/lista/store', 'ListaController@store');
        Route::get('/listagrupo1', 'ListaController@listagrupo1');
        Route::get('/detallelista', 'ListaController@Detallelistaindex');

        Route::get('/listaProceso1', 'ListaController@listaProceso1');
        Route::get('/listaVerificar', 'RfidController@listaVerificar');
        Route::get('/genero/selectGenero', 'GeneroController@selectGenero');
        Route::get('/grupo/selectGrupo', 'GrupoController@selectGrupo');
        Route::get('/grupo/index', 'GrupoController@index');
        Route::post('/grupo/registrar', 'GrupoController@store');
        Route::get('/lista-pdf', 'ListaController@pdfdetalleListagenerar')->name('pdf.generar');
        Route::post('/generar-pdf-detallelista', 'ListaController@pdfdetalleLista')->name('pdf.detallelista');
        Route::post('/generar-pdf-lista', 'ListaController@listaPdf');
        Route::delete('/ingreso/eliminar/{id}', 'ListaController@eliminar');
        Route::post('/Detallelistapdfindex', 'ListaController@Detallelistapdfindex')->name('pdf.generar');
        Route::get('/persona/selectPersona', 'PersonaController@selectPersona');
        Route::get('/personas/ver/{id}','PersonaController@autollenarPersona');

        Route::get('/rfid/index', 'RfidController@index');
        Route::get('/rfid/verInformacion', 'RfidController@verInformacion');
        Route::get('/rfid/indexAdministrador', 'RfidController@indexAdministrador');
        Route::get('/rfid/indexAfiliado', 'RfidController@indexAfiliado');
        Route::get('/rfid/indexlistaAfiliado', 'RfidController@indexlistaAfiliado');
        Route::post('/rfid/ver','RfidController@autollenarRfid');
        Route::post('/rfid/registrar', 'RfidController@store');
        Route::post('/rfid/actualizar', 'RfidController@update');
        Route::get('/rfid/verificar', 'RfidController@verificar');
        Route::post('/rfid/proceso1', 'RfidController@Proceso1');
        Route::post('/rfid/actualizarIdGeneroLista', 'RfidController@actualizarIdGeneroLista');
        Route::delete('/rfid/eliminar/{id}', 'RfidController@eliminar');
        Route::post('/rfid/pdf', 'RfidController@pdf')->name('pdf.generate');
        Route::get('/rfid/excel', 'RfidController@excel')->name('excel.generate');
        Route::get('/rfid/indexCorral', 'RfidController@indexCorral');

        Route::get('/procesofinal/index', 'ProcesofinalController@index');
        Route::post('/procesofinal/ver','ProcesofinalController@autollenarRfid');
        Route::get('/procesofinal/listaVerificar', 'ProcesofinalController@listaVerificar');
        Route::post('/procesofinal', 'ProcesofinalController@ProcesoFinal');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');

        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::post('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::post('/user/verificarMarca', 'UserController@verificarMarca');

        Route::get('/cargo/selectCargo', 'CargoController@selectCargo');

        Route::get('/informaciones/indexInformacion', 'NoticiasController@indexInformacion');
        Route::post('/registrarInformacion', 'NoticiasController@registrarInformacion');
        Route::delete('/informacion/eliminar', 'NoticiasController@eliminarInformacion');

        Route::post('/variables/actualizarTotal', 'VariablesController@actualizarTotal');
        Route::get('/variables/indexVariables', 'VariablesController@index');

        Route::get('/IngresoEgreso/indexIngresoEgreso', 'IngresoEgresoController@indexIngresoEgreso');
        Route::delete('/egreso/eliminar/{id}', 'IngresoEgresoController@eliminar');
        Route::post('/egreso/registrar', 'IngresoEgresoController@storeEgreso');
        Route::get('/clasegresos/index', 'IngresoEgresoController@index');
        Route::post('/clasegresos/registrar', 'IngresoEgresoController@storeclasegresos');
        Route::get('/clasegresos/selectClasEgresos', 'IngresoEgresoController@selectClasEgresos');
        Route::post('/generar-pdf-egreso', 'IngresoEgresoController@egresoPdf');

        Route::get('/rfid/gmail',function(){
            Mail::to('orlandoguti698@gmail.com')->queue(new ContactanosMailable());
        });
        Route::get('/google/authorize', 'GoogleController@authorize');
        Route::get('/google/callback', 'GoogleController@callback');

        Route::post('/grupo/actualizar', 'GrupoController@update');
        Route::delete('/grupo/eliminar/{id}', 'GrupoController@eliminar');
        Route::post('/clasegreso/actualizar', 'IngresoEgresoController@update');
        Route::delete('/clasegreso/eliminarclasegreso/{id}', 'IngresoEgresoController@eliminarclasegreso');


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
        Route::get('/noticias/index', 'NoticiasController@index');
        Route::post('/noticia/registrar', 'NoticiasController@store');
        Route::delete('/noticia/eliminar', 'NoticiasController@eliminar');


    });


});

