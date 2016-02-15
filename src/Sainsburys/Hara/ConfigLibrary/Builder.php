<?php
namespace Sainsburys\Hara\ConfigLibrary;

use Sainsburys\Hara\ConfigLibrary\Config\FakeConfig;
use Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile;
use Sainsburys\Hara\ConfigLibrary\Misc\IniFileParser;

class Builder
{
    public function buildSecretConfigFile(string $pathToConfigFile): Config
    {
        return new SecretConfigFile($pathToConfigFile, new IniFileParser());
    }

    public function buildFakeConfigFile(): Config
    {
        return new FakeConfig();
    }
}
