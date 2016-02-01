<?php
namespace Sainsburys\Hara\Xxxxxx\Service\Test;

class RoutingConfigTest extends \PHPUnit_Framework_TestCase
{
    /** @var [] */
    private $routing;

    public function setUp()
    {
        $this->routing = [];
        $routingFiles = [
            APPLICATION_ROOT_DIR . 'config/routing.php',
        ];

        foreach ($routingFiles as $file) {
            $config = include $file;
            if (array_key_exists('routes', $config)) {
                $this->routing = array_merge($this->routing, $config['routes']);
            }
        }
    }

    public function testSmokeTestRouteExists()
    {
        $this->assertArrayHasKey('smoke-test', $this->routing);
        $this->assertArrayHasKey('http-verb', $this->routing['smoke-test']);
        $this->assertEquals('GET', $this->routing['smoke-test']['http-verb']);
    }
}
