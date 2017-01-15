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
            'client_id'     => '1515844942047533',
            'client_secret' => 'd48284d63d2c0b2824045651e29f35e2',
      //      'scope'         => array('email','read_friendlists','user_online_presence'),
			'scope'			=> array('email')
        ),
         /**
         * Facebook
         */
        'Twitter' => array(
            'client_id'     => 'l9wPiszfOjhghDM2sUQGnWuRL',
            'client_secret' => '8CI1UQ7ahumXKVAGHPKJUdiuQ30sy3YibYUtQS7YBcwySGobta',
        ),
         /**
         * Facebook
         */
        'Google' => array(
            'client_id'     => '553793515613-kghoefbcmreb0qbsigaim8nn3j6bplo2.apps.googleusercontent.com',
            'client_secret' => 'S2xcFfQ-PLFiTUm6WwJmmb4o',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),

	)

);
