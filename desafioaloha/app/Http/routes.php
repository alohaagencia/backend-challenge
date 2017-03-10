<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);

/* Início das Rotas do back-end admin  */
Route::group(array('middleware' => 'auth'), function()
{
	//Rota admin
	Route::get('/', "AdminController@index")->name('admin');

	//Rotas de Contatos
	Route::get('/contatos', 'ContatoController@index')->name('contatos');
	Route::get('/createContatos', "ContatoController@create")->name('criarContato');
	Route::post('/contatos/save', "ContatoController@store")->name('salvarContato');
	Route::get('/contatos/edit/{idContato}', "ContatoController@edit")->name('editarContato');
	Route::put('/contatos/update/{idContato}', "ContatoController@update")->name('alterarContato');
	Route::post('/contatos/{idContato}/delete', "ContatoController@destroy")->name('excluirContato');

	Route::get('/auth/logout', function(){
		Auth::logout();
	})->name('logout');

});
/* Fim das Rotas do back-end admin */
