<?php

namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sainsburys\Hara\ConfigLibrary\Exception\ConfigLibraryException;

class RequiredConfigSettingNotFoundSpec extends ObjectBehavior
{
    function it_is_an_exception()
    {
        $this->shouldHaveType(\RuntimeException::class);
        $this->shouldHaveType(ConfigLibraryException::class);
    }

    function it_has_a_message()
    {
        $this->beConstructedThrough('constructWithSettingKey', ['SETTING-KEY']);
        $this->getMessage()->shouldBe("The config file setting 'SETTING-KEY' does not exist");
    }
}
