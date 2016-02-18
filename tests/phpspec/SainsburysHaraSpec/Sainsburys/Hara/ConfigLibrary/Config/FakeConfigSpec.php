<?php
namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sainsburys\Hara\ConfigLibrary\Config;
use Sainsburys\Hara\ConfigLibrary\Config\FakeConfig;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

/**
 * @mixin FakeConfig
 */
class FakeConfigSpec extends ObjectBehavior
{
    function it_is_a_config_object()
    {
        $this->shouldHaveType(Config::class);
    }

    function it_supports_getting_and_setting_values()
    {
        $this->set('DB_PASSWORD', 'password');
        $this->get('DB_PASSWORD')->shouldBe('password');
    }

    function it_throws_an_exception_if_the_setting_doesnt_exist()
    {
        $this->shouldThrow(RequiredConfigSettingNotFound::class)->during('get', ['THING-THAT-DOESNT-EXIST']);
    }

    function it_can_tell_whether_its_on_dev()
    {
        $this->setIsDev(true);
        $this->isDev()->shouldBe(true);
    }

    function it_supports_getting_and_setting_a_dsn()
    {
        $this->setDsn('dsn-value');
        $this->dsnForService('anything')->shouldBe('dsn-value');
    }

    function it_throws_an_exception_if_dsn_has_not_been_set_before_accessing_it()
    {
        $this->shouldThrow(RequiredConfigSettingNotFound::class)->during('dsnForService', ['someService']);
    }

    function it_throws_an_exception_if_dev_is_not_explicitly_set_before_accessing_it()
    {
        $this->shouldThrow(RequiredConfigSettingNotFound::class)->during('isDev', ['someService']);
    }
}
