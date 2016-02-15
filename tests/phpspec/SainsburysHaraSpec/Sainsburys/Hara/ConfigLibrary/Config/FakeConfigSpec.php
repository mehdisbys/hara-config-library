<?php

namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sainsburys\Hara\ConfigLibrary\Config;
use Sainsburys\Hara\ConfigLibrary\Config\FakeConfig;

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
}
