<?php

use Interop\Container\ContainerInterface as Container;

return [

    'sainsburys.hara.xxxxxx.controllers.smoketest' =>
        function (Container $container) {
            return new \Sainsburys\Hara\Xxxxxx\Controller\SmokeTestController();
        },

];
