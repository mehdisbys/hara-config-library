<?php
namespace Sainsburys\Hara\ConfigLibrary\Misc;

interface IniFileParserInterface
{
    public function parseIniFile(string $path): array;
}
