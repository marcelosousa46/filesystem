<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index');
	Route::get('/usuario/{id}', 'HomeController@usuario');
	Route::post('/arquivo', 'HomeController@upload');
	Route::get('/download/{id}/{arquivo}', 'HomeController@download');
	Route::get('/delete/{id}/{arquivo}', 'HomeController@delete');
	Route::get('/desbloqueio', 'HomeController@listarUsuarios');
	Route::get('/desbloqueio/{id}', 'HomeController@desbloqueio');
	Route::get('/bloqueio/{id}', 'HomeController@bloqueio');
	Route::get('/upload', function () {
	    return view('upload');
	});
});
