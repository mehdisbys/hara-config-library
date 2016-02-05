<?php
namespace Sainsburys\Hara\Xxxxxx\Test;

use UltraLite\Container\Container;
use Sainsburys\Hara\Xxxxxx\Controller\SmokeTestController;

class DiConfigTest extends \PHPUnit_Framework_TestCase
{
    /** @var Container */
    private $diContainer;

    public function setUp()
    {
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
            ['sainsburys.hara.xxxxxx.controllers.smoketest', SmokeTestController::class],
        ];
    }
}
