<?php
namespace Sainsburys\Hara\ConfigLibrary\Test\IntegrationTesting;

use Behat\Behat\Context\Context;
use UltraLite\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Sainsburys\HttpService\Application;
use Zend\Diactoros\ServerRequest;

class SmokeTestContext implements Context
{
    /** @var Application */
    private $application;

    /** @var ResponseInterface */
    private $responseReceived;

    public function __construct()
    {
        require_once  __DIR__ . '/../../../../../../../bootstrap.php';

        $diContainer = new Container();
        $diContainer->configureFromFile(APPLICATION_ROOT_DIR . '/config/di.php');

        $this->application = Application::factory([APPLICATION_ROOT_DIR . '/config/routing.php'], $diContainer);
    }

    /**
     * @When I send a GET request to :path
     */
    public function iSendAGetRequestTo($path)
    {
        $request = new ServerRequest([], [], 'http://api.com' . $path, 'GET');
        $this->responseReceived = $this->application->run($request);
    }

    /**
     * @When I query the smoke test endpoint
     */
    public function iQueryTheSmokeTestEndpoint()
    {
        $request = new ServerRequest([], [], 'http://api.com/smoke-test', 'GET');
        $this->responseReceived = $this->application->run($request);
    }

    /**
     * @Then the response body should say the smoke test result is :expectedResult
     */
    public function theResponseBodyShouldSayTheSmokeTestResultIs($expectedResult)
    {
        $this->responseReceived->getBody()->rewind();
        $responseBodyReceived = $this->responseReceived->getBody()->getContents();

        $responseBodyArray = json_decode($responseBodyReceived, true);

        $smokeTestResult = $responseBodyArray['result'];

        \PHPUnit_Framework_Assert::assertEquals($expectedResult, $smokeTestResult);
    }
}
