<?php
namespace Sainsburys\Hara\ConfigLibrary\Misc;

use Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotReadable;
use Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotValid;

class IniFileParser implements IniFileParserInterface
{
    public function parseIniFile(string $path): array
    {
        if (!is_readable($path)) {
            throw new ConfigFileNotReadable();
        }

        $contents = parse_ini_file($path);

        if (!$contents) {
            throw new ConfigFileNotValid();
        }

        return $contents;
    }
}
