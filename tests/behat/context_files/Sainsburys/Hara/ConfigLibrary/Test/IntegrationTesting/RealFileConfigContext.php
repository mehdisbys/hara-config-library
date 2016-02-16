<?php
namespace Sainsburys\Hara\ConfigLibrary\Test\IntegrationTesting;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile;
use Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotReadable;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;
use Sainsburys\Hara\ConfigLibrary\Misc\IniFileParser;

class RealFileConfigContext implements Context, SnippetAcceptingContext
{
    /** @var SecretConfigFile */
    private $configObject;

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
        $this->configObject = new SecretConfigFile($filename, $iniFileParser);
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
     */
    public function iAskWhetherOrNotThisIsTheDevEnvironment()
    {
        $this->result = $this->configObject->isDev();
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

    /**
     * @When I get the DNS for the service :serviceNickname
     */
    public function iGetTheDnsForTheService(string $serviceNickname)
    {
        $this->result = $this->configObject->dsnForService($serviceNickname);
    }

    /**
     * @Then I should get an error message telling me the file is missing
     */
    public function iShouldGetAnErrorMessageTellingMeTheFileIsMissing()
    {
        \PHPUnit_Framework_Assert::assertInstanceOf(ConfigFileNotReadable::class, $this->exceptionThrown);
    }
}
