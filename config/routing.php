<?php
return [

    'routes' => [

        'smoke-test' => [
            'http-verb'             => 'GET',
            'path'                  => '/smoke-test',
            'controller-service-id' => 'sainsburys.hara.xxxxxx.controllers.smoketest',
            'action-method-name'    => 'smokeTestAction',
        ],

    ],

];
