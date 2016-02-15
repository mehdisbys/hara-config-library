<?php
namespace Sainsburys\Hara\ConfigLibrary\Misc;

class IniFileParser implements IniFileParserInterface
{
    public function parseIniFile(string $path): array
    {
        return parse_ini_file($path);
    }
}
