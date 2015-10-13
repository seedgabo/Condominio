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
// Variables compartidas en vistas
View::share('time', new Carbon\Carbon);

// controlador Admin
Route::any('admin', 'AdminController@Residencias');
Route::any('admin/eventos', 'AdminController@eventos');
Route::any('admin/areas', 'AdminController@areas');
Route::any('admin/directiva', 'AdminController@directiva');
Route::any('admin/facturas', 'AdminController@facturas');
Route::any('admin/Noticias', 'AdminController@Noticias');
Route::any('admin/Recibos', 'AdminController@Recibos');
Route::any('admin/Personas', 'AdminController@Personas');
Route::any('admin/Personal', 'AdminController@Personal');
Route::any('admin/Encuestas', 'AdminController@Encuestas');
Route::any('admin/Residencias', 'AdminController@Residencias');
Route::any('admin/Galeria', 'AdminController@Galeria');
Route::any('admin/Documentos', 'AdminController@documentos');

Route::any('admin/Email', 'AdminController@emailPorUsuario');
Route::any('admin/Email/Dueños', 'AdminController@EmailPorResidencia');
Route::any('admin/Email/Morosos', 'AdminController@emailPorMoroso');
Route::any('admin/Email/AlDia', 'AdminController@emailPorSolvencia');


Route::any('admin/Diseño/Portada', 'AdminController@Portada');
Route::any('admin/eliminarconcepto/{id}','AdminController@eliminarconcepto');


// Controlador Home
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

//Controladores de AJAX
Route::any('ajax/calendar/{action?}', 'AjaxController@Calendar');
Route::any('ajax/areas/{action?}', 'AjaxController@Areas');
Route::any('ajax/directiva/{action?}', 'AjaxController@Directiva');
Route::any('ajax/noticias/{action?}', 'AjaxController@noticias');
Route::any('ajax/recibos/{action?}', 'AjaxController@recibos');
Route::any('ajax/personas/{action?}', 'AjaxController@personas');
Route::any('ajax/personal/{action?}', 'AjaxController@personal');
Route::any('ajax/encuestas/{action?}', 'AjaxController@encuestas');
Route::any('ajax/residencias/{action?}', 'AjaxController@residencias');
Route::any('ajax/email', 'AjaxController@email');
Route::any("ajax/resultados-encuesta/{id}", 'AjaxController@resultadosEncuesta');
Route::any("ajax/cambiarsolvencia",'AjaxController@cambiarsolvencia');


// controladores de login y logout
Route::post('user', 'HomeController@login');
Route::any('logout', array('before' => 'auth', 'uses' => 'HomeController@logout'));
Route::any('registro',"HomeController@registro");


Route::any('generar-factura', function()
{
    $time = new Carbon\Carbon;
    $factura = DB::table('facturas')
    ->where("mes","=", Input::get('mes', $time->month))
    ->where("año","=",Input::get('año', $time->year))
    ->get();
    $persona = User::find(Input::get('persona_id',Auth::user()->id));
    $residencia = residencias::where("id","=", $persona->residencia_id)
    ->first();
    $html = View::make('pdf.factura')->withFactura($factura)->withResidencia($residencia)->withPersona($persona);
    $headers = array('Content-Type' => 'application/pdf');
    return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
});

Route::any("test", function()
{
    $credentials =Input::only('email','password');
        if(Auth::attempt($credentials, Input::get('remember', true)))
        {
            return  "Bienvenido" .  Auth::user()->nombre;
        }
        else 
            return "ERROR";
});