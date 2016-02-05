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

    /**
     * @dataProvider provideRoutes
     */
    public function testRoutesExist(string $method, string $routeId)
    {
        $this->assertArrayHasKey($routeId, $this->routing);
        $this->assertArrayHasKey('http-verb', $this->routing[$routeId]);
        $this->assertEquals($method, $this->routing[$routeId]['http-verb']);
    }

    public function provideRoutes()
    {
        return [
            ['GET', 'smoke-test'],
        ];
    }
}
