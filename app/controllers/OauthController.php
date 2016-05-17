<?php

class OauthController extends \BaseController {

	public function loginWithFacebook()
    {
        $code = Input::get('code');
        $fb = OAuth::consumer( 'Facebook' );
        if (!empty($code))
        {
            $token = $fb->requestAccessToken( $code );
            $result = json_decode( $fb->request( '/me?fields=email,name,gender,birthday' ), true );
            $user =User::where('email','=',$result['email'])->first();
            if($user != null)
            {
                $user->nombre = $result['name'];
                $user->avatar =  'https://graph.facebook.com/' . $result['id'] . '/picture?type=square';
                $user->save();
                Auth::login($user, false);
                Session::flash('message',"<img src='".$user->avatar ."' height='70' alt=''> Sesion iniciada con Facebook<br> Bienvenido " . $result['name']);
                return Redirect::to("/");
            }
            else
            {
                Session::flash('message',  "No Existe ningun usuario con ese correo");
                return Redirect::to("/");
            }
        }
        else
        {
            $url = $fb->getAuthorizationUri();
            return Redirect::to( (string)$url );
        }
    }

    public function RegisterWithFacebook()
    {
        $code = Input::get('code');
        $fb = OAuth::consumer( 'Facebook' );
        if (!empty($code))
        {
            $token = $fb->requestAccessToken( $code );
            $result = json_decode( $fb->request( '/me?fields=email,name' ), true );
            $user = User::firstOrCreate(array('email' => $result['email']));
            if($user != null)
            {
                $user->nombre = $result['name'];
                $user->avatar =  'https://graph.facebook.com/' . $result['id'] . '/picture?type=large';
                $user->save();
                Auth::login($user, false);
                Session::flash('message',"<img src='".$user->avatar ."' height='70' alt=''> Registrado  con Facebook <br> Bienvenido " . $result['name']);
				if(Auth::user()->residencia_id == null)
					return Redirect::to("register/completar-registro");
				else
					return Redirect::to("/");
            }
            else
            {
                Session::flash('message',  "Error al Crear usuario");
                return Redirect::to("/");
            }
        }
        else
        {
            $url = $fb->getAuthorizationUri();
            return Redirect::to( (string)$url );
        }
    }

    public function loginWithGoogle()
    {
        $code = Input::get( 'code' );
        $googleService = OAuth::consumer( 'Google' );
        if ( !empty( $code ) ) {
            $token = $googleService->requestAccessToken( $code );
            $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
            $user =User::where('email','=',$result['email'])->first();
            if($user != null)
            {
                $user->nombre = $result['name'];
                $user->avatar =  $result['picture'];
                $user->save();
                Auth::login($user, false);
                Session::flash('message',"<img src='".$user->avatar ."' height='70' alt=''> Sesion iniciada con Google<br> Bienvenido " . $result['name']);
                return Redirect::to("/");
            }
            else
            {
                Session::flash('message',  "No Existe ningun usuario con ese correo");
                return Redirect::to("/");
            }
        }
        else {
            $url = $googleService->getAuthorizationUri();
            return Redirect::to( (string)$url );
        }
    }

    public function RegisterWithGoogle()
    {
        $code = Input::get( 'code' );
        $googleService = OAuth::consumer( 'Google' );
        if ( !empty( $code ) ) {
            $token = $googleService->requestAccessToken( $code );
            $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
            $user = User::firstOrCreate(array('email' => $result['email']));
            if($user != null)
            {
                $user->nombre = $result['name'];
                $user->avatar =  $result['picture'];
                $user->save();
                Auth::login($user, false);
                Session::flash('message',"<img src='".$user->avatar ."' height='70' alt=''> Registrado  con Facebook <br> Bienvenido " . $result['name']);
                if(Auth::user()->residencia_id == null)
					return Redirect::to("register/completar-registro");
				else
					return Redirect::to("/");
            }
            else
            {
                Session::flash('message',  "Error al Crear usuario");
                return Redirect::to("/");
            }
        }
        else {
            $url = $googleService->getAuthorizationUri();
            return Redirect::to( (string)$url );
        }
    }

    public function completarRegistro()
    {
		if(Auth::user()->residencia_id != null){
			Session::flash("message",'Usted ya completó el registro satisfactoriamente');
 			return Redirect::to("/");
		}

        if(Input::has('keycode') )
        {
            //Verificar Keycode
            if(Input::get("keycode")!= Config::get('var.keycode'))
            {
                Session::flash('message', "El Codigo suministrado por el condominio no coincide");
                return Redirect::to("register/completar-registro");
            }
             //Validar Campos
            $rules =  array(
                'password' =>'min:8|max:50',
				'telefono' => 'min:3|max:50'
                );
            $validation = Validator::make(Input::except('_token'),$rules);
            if ($validation->fails())
            {
                return Redirect::to('register/completar-registro')->withErrors($validation);
            }


            $user = Auth::user();
            if (Input::get('password') != null)
            {
                $user->password = Hash::make(Input::get('password'));
            }

            $user->residencia_id = Input::get('residencia_id');
			$user->telefono  = Input::get('telefono');
            $user->save();
            Session::flash('message',"<img src='".$user->avatar ."' height='70' alt=''> Sesion iniciada <br> Bienvenido " . Auth::user()->nombre) ;
            return Redirect::to("/");

        }
        $residencias = Residencias::lists('nombre','id');
        return View::make('completarRegistro')->withResidencias($residencias);
    }

}
