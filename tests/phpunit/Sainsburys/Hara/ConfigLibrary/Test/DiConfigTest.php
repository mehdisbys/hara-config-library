<?php
namespace Sainsburys\Hara\ConfigLibrary\Test;

use UltraLite\Container\Container;
use Sainsburys\Hara\ConfigLibrary\Controller\SmokeTestController;

class DiConfigTest extends \PHPUnit_Framework_TestCase
{
    /** @var Container */
    private $diContainer;

    public function setUp()
    {
        $this->markTestIncomplete();
        $this->diContainer = new Container();
        $this->diContainer->configureFromFile(APPLICATION_ROOT_DIR . '/config/di.php');
    }

    /**
     * @dataProvider provideControllers
     */
    public function testControllersAreAvailable(string $serviceId, string $expectedClass)
    {
        $result = $this->diContainer->get($serviceId);
        $this->assertInstanceOf($expectedClass, $result);
    }

    public function provideControllers()
    {
        return [
            ['sainsburys.hara.config-library.controllers.smoketest', SmokeTestController::class],
        ];
    }
}
