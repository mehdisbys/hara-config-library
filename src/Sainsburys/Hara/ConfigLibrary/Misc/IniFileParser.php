<?php
namespace Sainsburys\Hara\ConfigLibrary\Misc;

use Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotReadable;
use Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotValid;

class IniFileParser implements IniFileParserInterface
{
    public function parseIniFile(string $path): array
    {
        if (!is_readable($path)) {
            throw new ConfigFileNotReadable($path);
        }

        $fileContents = file_get_contents($path);

        // Remove any lines which start with a hash comment
        $fileContents = preg_replace('/^\s*#.*$/m', '', $fileContents);

        $contents = parse_ini_string($fileContents);

        if (!$contents) {
            throw new ConfigFileNotValid();
        }

        return $contents;
    }
}
