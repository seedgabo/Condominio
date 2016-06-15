<?php

// Variables compartidas en vistas
View::share('time', new Carbon);

// controlador Admin
Route::group(array('prefix' => 'admin'), function()
{
    Route::any('/', 'GraphController@Graphs');
    Route::post('push','AdminController@push');
    Route::any('eventos', 'AdminController@eventos');
    Route::any('areas', 'AdminController@areas');
    Route::any('directiva', 'AdminController@directiva');
    Route::any('Noticias', 'AdminController@Noticias');
    Route::any('Recibos', 'AdminController@Recibos');
    Route::any('Personas', 'AdminController@Personas');
    Route::any('Personal', 'AdminController@Personal');
    Route::any('Vehiculos', 'AdminController@Vehiculos');
    Route::any('Visitantes', 'AdminController@Visitantes');
    Route::any('Encuestas', 'AdminController@Encuestas');
    Route::any('Residencias', 'AdminController@Residencias');
    Route::any('Galeria', 'AdminController@Galeria');

    Route::any('Documentos', 'AdminController@documentos');
    Route::any('agregar-documento-dinamico', 'AdminController@agregarDocumento');
    Route::any('editar-documento-dinamico/{id}', 'AdminController@editarDocumento');
    Route::any('eliminar-documento-dinamico/{id}', 'AdminController@eliminarDocumento');
    Route::any('cambiar-documento-dinamico/{id}', 'AdminController@toggleDocumento');

    Route::any('Email', 'AdminController@emailPorUsuario');
    Route::any('Email/Dueños', 'AdminController@EmailPorResidencia');
    Route::any('Email/Morosos', 'AdminController@emailPorMoroso');
    Route::any('Email/AlDia', 'AdminController@emailPorSolvencia');


    Route::any('Diseño/Portada', 'AdminController@Portada');
});

// Controlador Finanzas
Route::group(array('prefix' => 'admin/Finanzas'), function()
{
    Route::any('cuotas', 'FinanzasController@facturas');
    Route::any('cuotasPorResidencia', 'FinanzasController@facturasPorResidencia');
    Route::any('cuotasMasivas', 'FinanzasController@cuotasMasivas');
    Route::any('parametros', 'FinanzasController@parametros');
    Route::any('gestion', 'FinanzasController@gestionResidencias');
    Route::any('cargar-cobros', 'FinanzasController@cargarCobros');
    Route::any('generarResumendeCobrosMes', 'FinanzasController@generarResumendeCobrosMes');

    Route::any('eliminarconcepto/{id}','FinanzasController@eliminarconcepto');
    Route::any('eliminarconceptomasivo/{concepto}','FinanzasController@eliminarconceptomasivo');
});

//Controlador de AJAX
Route::group(array('prefix' => 'ajax'), function()
{
    Route::any('calendar/{action?}', 'AjaxController@Calendar');
    Route::any('areas/{action?}', 'AjaxController@Areas');
    Route::any('directiva/{action?}', 'AjaxController@Directiva');
    Route::any('noticias/{action?}', 'AjaxController@noticias');
    Route::any('recibos/{action?}', 'AjaxController@recibos');
    Route::any('personas/{action?}', 'AjaxController@personas');
    Route::any('personal/{action?}', 'AjaxController@personal');
    Route::any('vehiculos/{action?}', 'AjaxController@vehiculos');
    Route::any('visitantes/{action?}', 'AjaxController@visitantes');
    Route::any('encuestas/{action?}', 'AjaxController@encuestas');
    Route::any('residencias/{action?}', 'AjaxController@residencias');
    Route::any('solvencias/{action?}', 'AjaxController@solvencias');
    Route::any('email', 'AjaxController@email');
    Route::any("resultados-encuesta/{id}", 'AjaxController@resultadosEncuesta');
    Route::any("cambiarsolvencia",'AjaxController@cambiarsolvencia');
});

//Controlador de API's
Route::group(array('prefix' => 'api'), function()
{
    Route::resource('areas', 'AreasController');
    Route::resource('directiva', 'DirectivaController');
    Route::resource('noticias', 'NoticiasController');
    Route::resource('encuestas', 'EncuestasController');
    Route::resource('residencias', 'ResidenciasController');
    Route::resource('portadas', 'PortadasController');
    Route::resource('eventos', 'EventosController');
    Route::resource('galeria', 'GaleriaController');
    Route::resource('documentos', 'DocumentosController');
    Route::resource('vehiculos', 'VehiculosController');
    Route::resource('personal', 'PersonalController');
    Route::resource('visitantes', 'VisitantesController');
    Route::resource('dispositivos', 'DispositivosController');
    Route::any('generar-factura', array('uses' => 'HomeController@generarFactura'));
    Route::any('generar-documento/{id}', array('uses' => 'HomeController@generarDocumento'));

    Route::any("login", array('uses' => function()
    {
        if (Auth::user())
        {
            return json_encode(array_add(Auth::user(),"status",true));
        }
        return json_encode(array("status" =>false));
    }));
});

// Controlador Oauth
Route::group(array(), function()
{
    Route::any('login/facebook', 'OauthController@LoginWithFacebook');
    Route::any('login/google', 'OauthController@LoginWithGoogle');
    Route::any('register/facebook', 'OauthController@RegisterWithFacebook');
    Route::any('register/google', 'OauthController@RegisterWithGoogle');
    Route::any('register/completar-registro', 'OauthController@completarRegistro');
});

// Controlador Home
Route::group(array(), function()
{
    Route::any('/', 'HomeController@inicio');
    Route::get('directiva', 'HomeController@verdirectiva');
    Route::any('agregar-noticia',array('before' => 'auth', 'uses' =>  'HomeController@agregarnoticia'));
    Route::any('agregar-evento',array('before' => 'auth', 'uses' => 'HomeController@agregarevento'));
    Route::any('agregar-recibo',array('before' => 'auth', 'uses' => 'HomeController@agregarrecibo'));
    Route::any('agregar-imagen', array('before'=>'auth' , 'uses' => "HomeController@agregarimagen"));
    Route::any('eliminar-recibo/{id}',array('before' => 'auth', 'uses' => 'HomeController@eliminarrecibo'));
    Route::any('eliminar-personal/{id}',array('before' => 'auth', 'uses' => 'HomeController@eliminarpersonal'));
    Route::any('eliminar-vehiculo/{id}',array('before' => 'auth', 'uses' => 'HomeController@eliminarVehiculo'));
    Route::any('eliminar-noticia/{id}',array('before' => 'auth', 'uses' => 'HomeController@eliminarnoticia'));
    Route::any('ver-recibos',array('before' => 'auth', 'uses' => 'HomeController@verrecibos'));
    Route::any('ver-documentos',array('before' => 'auth', 'uses' => 'HomeController@verdocumentos'));
    Route::any('ver-residencia',array('before' => 'auth', 'uses' => 'HomeController@verresidencia'));
    Route::any('ver-personal',array('before' => 'auth', 'uses' => 'HomeController@verpersonal'));
    Route::any('ver-vehiculos',array('before' => 'auth', 'uses' => 'HomeController@vervehiculos'));
    Route::any('ver-visitantes',array('before' => 'auth', 'uses' => 'HomeController@vervisitantes'));
    Route::any('ver-encuestas',array('before' => 'auth', 'uses' => 'HomeController@verencuestas'));
    Route::any('ver-eventos','HomeController@verfullcalendar');
    Route::any('ver-galeria', "HomeController@vergaleria");
    Route::any('ver-noticias', "HomeController@vernoticias");
    Route::any('perfil',array('before' => 'auth' ,'uses' => 'HomeController@perfil'));
    Route::any('editar-residencia',array('before' => 'auth', 'uses' => 'HomeController@editarResidencia'));
    Route::any('generar-factura',array('before' => 'auth', 'uses' => 'HomeController@generarFactura'));
    Route::any('generar-documento/{id}', array('before' => 'auth', 'uses' => 'HomeController@generarDocumento'));
    Route::get('generar-recibo/{id}',  array('before' => 'auth', 'uses' => 'HomeController@generarRecibo'));

    // Controladores de login, logout y resetPassword
    Route::post('user', 'HomeController@login');
    Route::any('logout', array('before' => 'auth', 'uses' => 'HomeController@logout'));
    Route::any('registro',"HomeController@registro");
    Route::any('forgot-password',array('before' => 'guest', 'uses' => 'HomeController@forgotPassword'));
    Route::controller('password', 'RemindersController');
});

//Miselaneo
Route::group(array(), function()
{
    Route::any('test', function(){
        
    });

    Route::any('demo', function()
    {
        Auth::loginUsingId(2, true);
        Return Redirect::to('/');
    });

    Route::any('reset', function()
    {
        header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Origin: *');
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        return "hecho";
    });

    Route::any("printInput",function()
    {
       header('Access-Control-Allow-Origin:*');
       return json_encode(Input::all());
    });

    Route::any('hostname', function()
    {
      return gethostname();
    });

    Route::any('contacto', function(){
        $email = Input::get('emailContact');
        Mail::send('emails.contacto',array('contacto' => $email),function($message)
        {
             $message->from(Config::get('var.correo'), Config::get('var.nombre'));
             $message->to('sistema@residenciasonline.com');
        });
        Session::flash('message', "Contacto enviado!");
       return  Redirect::to('/');
    });

    Route::post('documento-preview',function(){
        $persona = Input::has('persona') ? User::find(Input::get('persona')) : Auth::user();
        $residencia = Input::has('residencia') ? Residencias::find(Input::get('residencia')) : $persona->residencia;

        $documento = Input::get("titulo", 'Mi Documento');
        $contenido = Input::get("contenido");

        $html = View::make('pdf.basic',["persona" => $persona, "residencia" => $residencia, 'contenido' => $contenido]);
        header('Content-Type : application/pdf');
		$headers = array('Content-Type' => 'application/pdf');
		return Response::make(PDF::load($html, 'A4', 'portrait')->show($documento), 200, $headers);
    });

    Route::get('chat-frame',['before' => 'auth'  , 'uses'=> function() {
            Return View::make('chat.chat');
    }]);
    Route::get('chat',['before' => 'auth'  , 'uses'=> function() {
            Return View::make('chat.chat-full');
    }]);
});
