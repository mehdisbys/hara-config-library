<?php
namespace Sainsburys\Hara\ConfigLibrary\Config;

use Sainsburys\Hara\ConfigLibrary\Exception\ConfigFileNotReadable;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;
use Sainsburys\Hara\ConfigLibrary\Misc\IniFileParserInterface;

class SecretConfigFile
{
    private $pathToSettingsFile;

    private $iniFileParser;

    /** @var string[] */
    private $settingsFileContents;

    public function __construct(string $pathToSettingsFile, IniFileParserInterface $iniFileParser)
    {
        $this->pathToSettingsFile = $pathToSettingsFile;
        $this->iniFileParser = $iniFileParser;
    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function get(string $settingName): string
    {
        if (!isset($this->fileContents()[$settingName])) {
            throw RequiredConfigSettingNotFound::constructWithSettingKey($settingName);
        }
        return $this->fileContents()[$settingName];
    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function dsnForService(string $serviceNickname): string
    {
        return 'pgsql:dbname=' . $database . ';host=' . $hostname . ';user='.$username . ';password=' . $password;
    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function isDev(): string
    {

    }

    private function fileContents(): array
    {
        if (!$this->settingsFileContents) {
            $this->settingsFileContents = $this->iniFileParser->parseIniFile($this->pathToSettingsFile);
        }
        return $this->settingsFileContents;
    }
}
