<?php
namespace Sainsburys\Hara\ConfigLibrary\Misc;

class IniFileParser
{
    public function parseIniFile(string $path)
    {
        return parse_ini_file($path);
    }
}
