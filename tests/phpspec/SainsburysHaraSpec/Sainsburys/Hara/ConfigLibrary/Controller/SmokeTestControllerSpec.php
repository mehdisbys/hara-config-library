<?php
namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Diactoros\ServerRequest;
use Slim\Http\Response;
use Teapot\StatusCode\Http;

class SmokeTestControllerSpec extends ObjectBehavior
{
    function it_is_initialisable()
    {
        $this->shouldHaveType('Sainsburys\Hara\ConfigLibrary\Controller\SmokeTestController');
    }

    function it_passes_when_called()
    {
        $requestPayload = fopen('php://memory','r+');
        fwrite($requestPayload, json_encode([]));
        rewind($requestPayload);

        $request  = new ServerRequest([], [], '/api.com/smoke-test', 'POST', $requestPayload);
        $response = new Response();

        $this->smokeTestAction($request, $response);
        $payload = json_decode($response->getBody());

        \PHPUnit_Framework_Assert::assertEquals(Http::OK, $response->getStatusCode());
        \PHPUnit_Framework_Assert::assertObjectHasAttribute('result', $payload);
        \PHPUnit_Framework_Assert::assertEquals('PASS', $payload->result);

    }
}
