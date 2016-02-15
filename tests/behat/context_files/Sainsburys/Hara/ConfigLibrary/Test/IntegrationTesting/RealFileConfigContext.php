<?php
namespace Sainsburys\Hara\ConfigLibrary\Test\IntegrationTesting;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;

class RealFileConfigContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given the config library is initialised with the file :arg1
     */
    public function theConfigLibraryIsInitialisedWithTheFile($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I get the setting :arg1
     */
    public function iGetTheSetting($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should get the value :arg1
     */
    public function iShouldGetTheValue($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I try to get the setting :arg1
     */
    public function iTryToGetTheSetting($arg1)
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

    /**
     * @When I try to get the Postgres DSN for the :arg1 service
     */
    public function iTryToGetThePostgresDsnForTheService($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should get :arg1
     */
    public function iShouldGet($arg1)
    {
        throw new PendingException();
    }
}
