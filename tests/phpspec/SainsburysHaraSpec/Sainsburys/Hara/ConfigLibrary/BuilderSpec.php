<?php
namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sainsburys\Hara\ConfigLibrary\Config\FakeConfig;
use Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile;
use Sainsburys\Hara\ConfigLibrary\Misc\IniFileParser;

class BuilderSpec extends ObjectBehavior
{
    function it_can_build_a_real_config_object()
    {
        $iniParser = new IniFileParser();
        $path = '/path/to/file.ini';

        $this->buildSecretConfigFile($path)->shouldBeLike(
            new SecretConfigFile($path, $iniParser)
        );
    }

    function it_can_build_a_fake_config_object()
    {
        $this->buildFakeConfigFile()->shouldBeLike(
            new FakeConfig()
        );
    }
}
