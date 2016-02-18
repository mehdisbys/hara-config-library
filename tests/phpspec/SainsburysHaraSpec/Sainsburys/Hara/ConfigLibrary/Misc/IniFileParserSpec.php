<?php

namespace SainsburysHaraSpec\Sainsburys\Hara\ConfigLibrary\Misc;

define('FIXTURE_DIR', realpath(dirname(__FILE__) . '/../../../../../../fixtures'));

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IniFileParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sainsburys\Hara\ConfigLibrary\Misc\IniFileParser');
    }

    function it_should_implement_IniFileParserInterface()
    {
        $this->beAnInstanceOf('Sainsburys\Hara\ConfigLibrary\Misc\IniFileParserInterface');
    }

    function it_can_parse_an_ini_file()
    {
        // ARRANGE
        // ACT
        $result = $this
            ->parseIniFile(FIXTURE_DIR . '/example-config-file.ini')
            ->getWrappedObject();

        // ASSERT
        \PHPUnit_Framework_Assert::assertArrayHasKey('DB_IMPORTRECIPE_DATABASE', $result);
        \PHPUnit_Framework_Assert::assertEquals('recipes', $result['DB_IMPORTRECIPE_DATABASE']);
    }

    function it_throws_an_exception_when_the_ini_file_is_empty()
    {
        $this
            ->shouldThrow('Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotValid')
            ->during('parseIniFile', [FIXTURE_DIR . '/empty-config-file.ini']);
    }

    function it_throws_an_exception_when_an_ini_file_cannot_be_found()
    {
        $this
            ->shouldThrow('Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotReadable')
            ->during('parseIniFile', [FIXTURE_DIR . '/non-existing-config-file.ini']);
    }

    function it_throws_a_runtime_exception_when_an_ini_file_cannot_be_parsed()
    {
        $this
            ->shouldThrow('\RuntimeException')
            ->during('parseIniFile', [FIXTURE_DIR . '/invalid-config-file.ini']);
    }
}
