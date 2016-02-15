<?php
namespace Sainsburys\Hara\ConfigLibrary\Test\IntegrationTesting;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;
use Sainsburys\Hara\ConfigLibrary\Misc\IniFileParser;

class RealFileConfigContext implements Context, SnippetAcceptingContext
{
    /** @var SecretConfigFile */
    private $secretConfigFile;

    /** @var string */
    private $result;

    /** @var \Exception|null */
    private $exceptionThrown;

    /**
     * @Given the config library is initialised with the file :filename
     */
    public function theConfigLibraryIsInitialisedWithTheFile(string $filename)
    {
        $iniFileParser = new IniFileParser();
        $this->secretConfigFile = new SecretConfigFile($filename, $iniFileParser);
    }

    /**
     * @When I get the setting :settingKey
     */
    public function iGetTheSetting(string $settingKey)
    {
        $this->result = $this->secretConfigFile->get($settingKey);
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
            $this->secretConfigFile->get($settingKey);
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
     */
    public function iAskWhetherOrNotThisIsTheDevEnvironment()
    {
        $this->result = $this->secretConfigFile->isDev();
    }

    /**
     * @Then I should get a response of true
     */
    public function iShouldGetAResponseOfTrue()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->result);
    }

    /**
     * @When I try to get the Postgres DSN for the :arg1 service
     */
    public function iTryToGetThePostgresDsnForTheService(string $serviceName)
    {
        $this->result = $this->secretConfigFile->dsnForService($serviceName);
    }
}
