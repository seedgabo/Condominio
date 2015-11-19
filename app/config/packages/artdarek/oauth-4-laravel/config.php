<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
		'Facebook' => array(
			'client_id'     => '798637466926383',
			'client_secret' => 'e3437395765795f3421c8bd1a4809de0',
			'scope'         => array('email','user_birthday'),
			),		
		'Google' => array(
			'client_id'     => '686403890720-q6f77g0e8ferfvj77bnmonbo77m4ljj2.apps.googleusercontent.com',
			'client_secret' => 'T699WbmwZvL7h7-ra-SSHRh6',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
			),  

		)

	);