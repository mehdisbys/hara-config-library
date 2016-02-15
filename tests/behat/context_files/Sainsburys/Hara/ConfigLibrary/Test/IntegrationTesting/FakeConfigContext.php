<?php
namespace Sainsburys\Hara\ConfigLibrary\Test\IntegrationTesting;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class FakeConfigContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given I have injected the setting :settingKey with the value :settingValue
     */
    public function iHaveInjectedTheSettingWithTheValue(string $settingKey, string $settingValue)
    {
        throw new PendingException();
    }

    /**
     * @Given I have injected true as a value whether or not we're on dev
     */
    public function iHaveInjectedTrueAsAValueWhetherOrNotWeReOnDev()
    {
        throw new PendingException();
    }

    /**
     * @Given I have injected the DSN :dsn
     */
    public function iHaveInjectedTheDsn(string $dsn)
    {
        throw new PendingException();
    }

    /**
     * @When I get the DNS for the service :serviceNickname
     */
    public function iGetTheDnsForTheService(string $serviceNickname)
    {
        throw new PendingException();
    }

    /**
     * @When I get the setting :settingKey
     */
    public function iGetTheSetting(string $settingKey)
    {
        throw new PendingException();
    }

    /**
     * @Then I should get the value :expectedSettingValue
     */
    public function iShouldGetTheValue($expectedSettingValue)
    {
        throw new PendingException();
    }

    /**
     * @When I try to get the setting :settingKey
     */
    public function iTryToGetTheSetting(string $settingKey)
    {
        throw new PendingException();
    }

    /**
     * @Then I should get a helpful error message
     */
    public function iShouldGetAHelpfulErrorMessage()
    {
        throw new PendingException();
    }

    /**
     * @When I ask whether or not this is the dev environment
     */
    public function iAskWhetherOrNotThisIsTheDevEnvironment()
    {
        throw new PendingException();
    }

    /**
     * @Then I should get a response of true
     */
    public function iShouldGetAResponseOfTrue()
    {
        throw new PendingException();
    }
}
