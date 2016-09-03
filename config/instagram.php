<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Instagram Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'id' => '5a63c31032eb4bcbaab4da66021811c3',
            'secret' => '9ec0be3cab6842ffa3512cacc81adf3d ',
            'access_token' => '{"access_token": "197251860.5a63c31.cde9716115804cb9892dd2fd0687f6b7"}',
        ],

        'token' => [
            'id' => '5a63c31032eb4bcbaab4da66021811c3',
            'secret' => '9ec0be3cab6842ffa3512cacc81adf3d ',
            'access_token' => '{"access_token": "197251860.5a63c31.cde9716115804cb9892dd2fd0687f6b7"}',
        ],

    ],

];
