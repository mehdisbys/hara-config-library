<?php

namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
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
                'DB_USERNAME' => 'hara',
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile');
    }

    function it_can_get_a_setting()
    {
        $this->get('DB_USERNAME')->shouldBe('hara');
    }

    function it_throws_an_exception_if_the_setting_doesnt_exist()
    {
        $this->shouldThrow(RequiredConfigSettingNotFound::class)->during('get', ['THING-THAT-DOESNT-EXIST']);
    }
}
