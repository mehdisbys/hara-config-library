<?php
namespace Sainsburys\Hara\ConfigLibrary\Test\IntegrationTesting;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Sainsburys\Hara\ConfigLibrary\Config\FakeConfig;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

class FakeConfigContext implements Context, SnippetAcceptingContext
{
    /** @var FakeConfig */
    private $configObject;

    /** @var string */
    private $result;

    /** @var \Exception|null */
    private $exceptionThrown;

    public function __construct()
    {
        $this->configObject = new FakeConfig();
    }

    /**
     * @Given I have injected the setting :settingKey with the value :settingValue
     */
    public function iHaveInjectedTheSettingWithTheValue(string $settingKey, string $settingValue)
    {
        $this->configObject->set($settingKey, $settingValue);
    }

    /**
     * @Given I have injected true as a value whether or not we're on dev
     */
    public function iHaveInjectedTrueAsAValueWhetherOrNotWeReOnDev()
    {
        $this->configObject->setIsDev(true);
    }

    /**
     * @Given I have injected false as a value whether or not we're on dev
     */
    public function iHaveInjectedFalseAsAValueWhetherOrNotWeReOnDev()
    {
        $this->configObject->setIsDev(false);
    }

    /**
     * @Given I have injected the DSN :dsn
     */
    public function iHaveInjectedTheDsn(string $dsn)
    {
        $this->configObject->setDsn($dsn);
    }

    /**
     * @When I get the DNS for the service :serviceNickname
     */
    public function iGetTheDnsForTheService(string $serviceNickname)
    {
        $this->result = $this->configObject->dsnForService($serviceNickname);
    }

    /**
     * @When I get the setting :settingKey
     */
    public function iGetTheSetting(string $settingKey)
    {
        $this->result = $this->configObject->get($settingKey);
    }

    /**
     * @Then I should get the value :expectedValue
     */
    public function iShouldGetTheValue(string $expectedValue)
    {
        \PHPUnit_Framework_Assert::assertEquals($expectedValue, $this->result);
    }

    /**
     * @When I try to get the setting :settingKey
     */
    public function iTryToGetTheSetting(string $settingKey)
    {
        try {
            $this->configObject->get($settingKey);
        } catch (\Throwable $exception) {
            $this->exceptionThrown = $exception;
        }
    }

    /**
     * @Then I should get a helpful error message
     */
    public function iShouldGetAHelpfulErrorMessage()
    {
        \PHPUnit_Framework_Assert::assertInstanceOf(RequiredConfigSettingNotFound::class, $this->exceptionThrown);
    }

    /**
     * @When I ask whether or not this is the dev environment
     * @When I try to ask whether or not this is the dev environment
     */
    public function iAskWhetherOrNotThisIsTheDevEnvironment()
    {
        try {
            $this->result = $this->configObject->isDev();
        } catch (\Throwable $exception) {
            $this->exceptionThrown = $exception;
        }
    }

    /**
     * @Then I should get a response of true
     */
    public function iShouldGetAResponseOfTrue()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->result);
    }

    /**
     * @Then I should get a response of false
     */
    public function iShouldGetAResponseOfFalse()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->result);
    }
}
