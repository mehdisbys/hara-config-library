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
        // ARRANGE
        $this->setIsDev(true);

        // ACT & ASSERT
        $this->isDev()->shouldBe(true);
    }

    function it_supports_getting_and_setting_a_dsn()
    {
        // ARRANGE
        $this->setDsn('dsn-value');

        // ACT & ASSERT
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

    function it_can_give_you_the_components_of_a_fake_dsn()
    {
        // ARRANGE
        $this->setDsn('pgsql:dbname=database-name;host=hostname;user=username;password=password');

        // ACT & ASSERT
        $this
            ->dsnComponentsForService('foobar')
            ->shouldBe(
                [
                    'adapter'  => 'pgsql',
                    'dbname'   => 'database-name',
                    'host'     => 'hostname',
                    'user'     => 'username',
                    'password' => 'password',
                ]
            );
    }

    function it_can_give_you_the_components_of_a_fake_sqlite_dsn()
    {
        // ARRANGE
        $this->setDsn('sqlite:/tmp/sqlite.sq3');

        // ACT & ASSERT
        $this
            ->dsnComponentsForService('foobar')
            ->shouldBe(
                [
                    'adapter'  => 'sqlite',
                    'path'     => '/tmp/sqlite.sq3',
                ]
            );
    }

    function it_can_give_you_the_components_of_a_fake_sqlite_memory_dsn()
    {
        // ARRANGE
        $this->setDsn('sqlite::memory:');

        // ACT & ASSERT
        $this
            ->dsnComponentsForService('foobar')
            ->shouldBe(
                [
                    'adapter'  => 'sqlite',
                    'path'     => ':memory:',
                ]
            );
    }
}
