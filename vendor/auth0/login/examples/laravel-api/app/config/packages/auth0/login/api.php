<?php

return array(

    /*
    |--------------------------------------------------------------------------
    |   JWT aud
    |--------------------------------------------------------------------------
    |   The audience the JWT was intended to
    |
    */

    'audience'        => getenv('AUTH0_CLIENT_ID'),
    /*
    |--------------------------------------------------------------------------
    |   JWT Secret
    |--------------------------------------------------------------------------
    |   The secret used to encrypt the JWT
    |
    */

    'secret'     => getenv('AUTH0_CLIENT_SECRET')

);