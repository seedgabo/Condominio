<?php

// Variables compartidas en vistas
View::share('time', new Carbon);

// controlador Admin
Route::group(array('prefix' => 'admin'), function(){
    Route::any('/', 'GraphController@Graphs');
    Route::any('eventos', 'AdminController@eventos');
    Route::any('areas', 'AdminController@areas');
    Route::any('directiva', 'AdminController@directiva');
    Route::any('facturas', 'AdminController@facturas');
    Route::any('Noticias', 'AdminController@Noticias');
    Route::any('Recibos', 'AdminController@Recibos');
    Route::any('Personas', 'AdminController@Personas');
    Route::any('Personal', 'AdminController@Personal');
    Route::any('Encuestas', 'AdminController@Encuestas');
    Route::any('Residencias', 'AdminController@Residencias');
    Route::any('Galeria', 'AdminController@Galeria');
    Route::any('Documentos', 'AdminController@documentos');

    Route::any('Email', 'AdminController@emailPorUsuario');
    Route::any('Email/Dueños', 'AdminController@EmailPorResidencia');
    Route::any('Email/Morosos', 'AdminController@emailPorMoroso');
    Route::any('Email/AlDia', 'AdminController@emailPorSolvencia');


    Route::any('Diseño/Portada', 'AdminController@Portada');
    Route::any('eliminarconcepto/{id}','AdminController@eliminarconcepto');
});

//Controladores de AJAX
Route::group(array('prefix' => 'ajax'), function()
{
    Route::any('calendar/{action?}', 'AjaxController@Calendar');
    Route::any('areas/{action?}', 'AjaxController@Areas');
    Route::any('directiva/{action?}', 'AjaxController@Directiva');
    Route::any('noticias/{action?}', 'AjaxController@noticias');
    Route::any('recibos/{action?}', 'AjaxController@recibos');
    Route::any('personas/{action?}', 'AjaxController@personas');
    Route::any('personal/{action?}', 'AjaxController@personal');
    Route::any('encuestas/{action?}', 'AjaxController@encuestas');
    Route::any('residencias/{action?}', 'AjaxController@residencias');
    Route::any('email', 'AjaxController@email');
    Route::any("resultados-encuesta/{id}", 'AjaxController@resultadosEncuesta');
    Route::any("cambiarsolvencia",'AjaxController@cambiarsolvencia');
});

//Controladores de API's
Route::group(array('prefix' => 'api'), function()
{
    Route::resource('noticias', 'NoticiasController');
    Route::resource('encuestas', 'EncuestasController');
    Route::resource('residencias', 'ResidenciasController');
    Route::resource('portadas', 'PortadasController');
    Route::resource('eventos', 'EventosController');
    Route::resource('galeria', 'GaleriaController');
});

// Controlador Oauth
Route::group(array(), function(){
    Route::any('login/facebook', 'OauthController@LoginWithFacebook');
    Route::any('login/google', 'OauthController@LoginWithGoogle');
    Route::any('register/facebook', 'OauthController@RegisterWithFacebook');
    Route::any('register/google', 'OauthController@RegisterWithGoogle');
    Route::any('register/completar-registro', 'OauthController@completarRegistro');
});

// Controlador Home
Route::group(array(), function(){
    Route::any('/', 'HomeController@inicio');
    Route::get('directiva', 'HomeController@verdirectiva');
    Route::any('agregar-noticia',array('before' => 'auth', 'uses' =>  'HomeController@agregarnoticia'));
    Route::any('agregar-evento',array('before' => 'auth', 'uses' => 'HomeController@agregarevento'));
    Route::any('agregar-recibo',array('before' => 'auth', 'uses' => 'HomeController@agregarrecibo'));
    Route::any('agregar-imagen', array('before'=>'auth' , 'uses' => "HomeController@agregarimagen"));
    Route::any('eliminar-recibo/{id}',array('before' => 'auth', 'uses' => 'HomeController@eliminarrecibo'));
    Route::any('eliminar-personal/{id}',array('before' => 'auth', 'uses' => 'HomeController@eliminarpersonal'));
    Route::any('ver-recibos',array('before' => 'auth', 'uses' => 'HomeController@verrecibos'));
    Route::any('ver-documentos',array('before' => 'auth', 'uses' => 'HomeController@verdocumentos'));
    Route::any('ver-residencia',array('before' => 'auth', 'uses' => 'HomeController@verresidencia'));
    Route::any('ver-personal',array('before' => 'auth', 'uses' => 'HomeController@verpersonal'));
    Route::any('ver-encuestas',array('before' => 'auth', 'uses' => 'HomeController@verencuestas'));
    Route::any('Usuario-Edit',array('before' => 'auth' ,'uses' => 'HomeController@usuarioEdit'));
    Route::any('editar-residencia',array('before' => 'auth', 'uses' => 'HomeController@editarResidencia'));
    Route::any('ver-eventos','HomeController@verfullcalendar');
    Route::any('ver-galeria', "HomeController@vergaleria");
    Route::any('ver-noticias', "HomeController@vernoticias");
		Route::any('generar-factura', 'HomeController@generarFactura' );


    // Controladores de login y logout
    Route::post('user', 'HomeController@login');
    Route::any('logout', array('before' => 'auth', 'uses' => 'HomeController@logout'));
    Route::any('registro',"HomeController@registro");
});



Route::any("test", function()
{
    header('Access-Control-Allow-Origin:*');
    if (Auth::attempt(Input::except('dominio'), false))
    {
        return json_encode(array_add(Auth::user(),"status",true));
    }
    return json_encode(array("status",false));
});

Route::any("printInput", function(){
   header('Access-Control-Allow-Origin:*'); 
   return json_encode(Input::all());
});
