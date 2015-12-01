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
		// return json_encode(Request::header('Authorization')); 
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
		header('Access-Control-Allow-Origin: *');
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
