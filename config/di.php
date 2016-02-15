<?php

use Interop\Container\ContainerInterface as Container;

return [

    'sainsburys.hara.config-library.controllers.smoketest' =>
        function (Container $container) {
            return new \Sainsburys\Hara\ConfigLibrary\Controller\SmokeTestController();
        },

];
