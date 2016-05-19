<?php

App::before(function($request)
{
});

App::after(function($request, $response)
{
	//
});

Route::filter('auth', function()
{

	if(Auth::check() && Auth::user()->residencia_id == null)
	{
		Session::flash('message', 'Antes de Acceder elige tu Residencia');
		return Redirect::to('register/completar-registro');
	}
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			Session::flash('message', 'Loguese Primero');
			return Redirect::guest('/');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('basic.once', function()
{

    return Auth::onceBasic();
});

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

// Filtro de clase administrador
Route::filter('admin', function()
{
	if (!Auth::user()->admin)
	{
		Session::flash('message', "No tiene Permisos para acceder a esta opción, si piensa que es un error por favor contacte con su administrador");
		return Redirect::to('/');
	}
});

// Filtro de las Api
Route::filter('api', function(){
	    header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization,  Key, Auth-Token');
		if(Request::method() != "OPTIONS")
		{
			if(Request::header("Auth-Token", null) != null){
				$user = User::find(Crypt::decrypt(Request::header("Auth-Token")));
				Auth::setUser($user);
			}
			else{
				return Auth::onceBasic('email');
			}
		}
});


Route::filter('ajax', function(){
	if (!Request::ajax())
	{
		return Response::make('Unauthorized', 401);
	}
});


// amarrando el filtro a todas las direcciones admin

Route::when('admin','auth|admin');
Route::when('admin/*', 'auth|admin');


//Mismo caso para API
Route::when('api/*','api');
