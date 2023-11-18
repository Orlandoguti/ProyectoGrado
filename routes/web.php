
<?php

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
        
        Route::get('/indexperiodo', 'PeriodoController@index');
        Route::get('/indexambiente', 'AmbienteController@index');
        Route::get('/indexdia', 'DiaController@index');
        Route::get('/selectAmbiente', 'AmbienteController@selectAmbiente');
        Route::post('/programa/store', 'ProgramaController@store');
        Route::get('/obtener-campos-ocupados/{idambiente}', 'ProgramaController@obtenerCamposOcupados');
        Route::post('/buscarambiente', 'AmbienteController@buscarambiente');

        Route ::post('users/import_excel','UserController@saveExcelUsers');
        Route::get('/selectMateria', 'MateriaController@selectMateria');
        Route::get('/selectCarrera', 'CarreraController@selectCarrera');
        Route::get('/idcarrerauser', 'UserController@obteneridCarrera');
        Route::get('/iduserget', 'UserController@obteneridUsuaio');

        Route::delete('/eliminar-campo', 'ProgramaController@eliminarRegistro');
        Route::get('/indexMateria', 'MateriaController@indexMateria');
        

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');

        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::post('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');


        Route::get('/cargo/selectCargo', 'CargoController@selectCargo');







    });
    Route::group(['middleware' => ['Personal']], function () {


    });

    Route::group(['middleware' => ['Director']], function () {


    });


});

