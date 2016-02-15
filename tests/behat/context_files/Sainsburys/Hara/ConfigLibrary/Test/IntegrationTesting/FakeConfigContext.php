<?php
namespace Sainsburys\Hara\ConfigLibrary\Test\IntegrationTesting;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class FakeConfigContext implements Context, SnippetAcceptingContext
{


    /**
     * @Given I have injected the setting :arg1 with the value :arg2
     */
    public function iHaveInjectedTheSettingWithTheValue($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given I have injected true as a value for isDev()
     */
    public function iHaveInjectedTrueAsAValueForIsdev()
    {
        throw new PendingException();
    }

    /**
     * @Given I have injected the DSN :arg1
     */
    public function iHaveInjectedTheDsn($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I get the DNS for the service :arg1
     */
    public function iGetTheDnsForTheService($arg1)
    {
        throw new PendingException();
    }
}
