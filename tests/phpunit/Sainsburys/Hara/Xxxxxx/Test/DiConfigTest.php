<?php
namespace Sainsburys\Hara\Xxxxxx\Test;

use UltraLite\Container\Container;

class DiConfigTest extends \PHPUnit_Framework_TestCase
{
    /** @var Container */
    private $diContainer;

    public function setUp()
    {
        $this->diContainer = new Container();
        $this->diContainer->configureFromFile(APPLICATION_ROOT_DIR . '/config/di.php');
    }

    public function testSmokeTestControllerIsRetrievable()
    {
        $expectedClass = '\Sainsburys\Hara\Xxxxxx\Controller\SmokeTestController';
        $result = $this->diContainer->get('sainsburys.hara.xxxxxx.controllers.smoketest');
        $this->assertInstanceOf($expectedClass, $result);
    }
}
