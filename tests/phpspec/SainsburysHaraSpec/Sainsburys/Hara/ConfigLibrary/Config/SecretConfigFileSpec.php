<?php

namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sainsburys\Hara\ConfigLibrary\Config;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;
use Sainsburys\Hara\ConfigLibrary\Misc\IniFileParserInterface;
use Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile;

/**
 * @mixin SecretConfigFile
 */
class SecretConfigFileSpec extends ObjectBehavior
{
    function let(IniFileParserInterface $iniFileParser)
    {
        $this->beConstructedWith('path.ini', $iniFileParser);

        $iniFileParser->parseIniFile('path.ini')->willReturn(
            [
                'ENVIRONMENT'      => 'dev',
                'DB_USERNAME'      => 'username',
                'DB_PASSWORD'      => 'password',
                'DB_AUTH_DATABASE' => 'database-name',
                'DB_HOST'          => 'hostname',
                'DB_AWS_HOST'      => 'rds.amazon.com',
                'DB_OTHER_HOST'    => 'db.example.com',
            ]
        );
    }

    function it_is_a_config_object()
    {
        $this->shouldHaveType(Config::class);
    }

    function it_can_get_a_setting()
    {
        $this->get('DB_USERNAME')->shouldBe('username');
    }

    function it_throws_an_exception_if_the_setting_doesnt_exist()
    {
        $this->shouldThrow(RequiredConfigSettingNotFound::class)->during('get', ['THING-THAT-DOESNT-EXIST']);
    }

    function it_can_tell_if_its_on_dev()
    {
        $this->isDev()->shouldBe(true);
    }

    function it_can_get_you_a_data_source_name()
    {
        $this
            ->dsnForService('auth')
            ->shouldBe("pgsql:dbname=database-name;host=hostname;user=username;password=password");
    }

    function it_can_get_you_different_data_source_names_with_an_optional_hint()
    {
        $this
            ->dsnForService('auth', 'AWS')
            ->shouldBe("pgsql:dbname=database-name;host=rds.amazon.com;user=username;password=password");

        $this
            ->dsnForService('auth', 'OTHER')
            ->shouldBe("pgsql:dbname=database-name;host=db.example.com;user=username;password=password");
    }
}
