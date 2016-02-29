<?php
namespace Sainsburys\Hara\ConfigLibrary\Config;

use Sainsburys\Hara\ConfigLibrary\Config;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;
use Sainsburys\Hara\ConfigLibrary\Misc\IniFileParserInterface;
use Sainsburys\Hara\ConfigLibrary\Config\Traits\DsnComponents;

class SecretConfigFile implements Config
{
    use DsnComponents;

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
    public function dsnForService(string $serviceNickname, string $alternative = null): string
    {
        if (empty($alternative)) {
            $hostVariable = 'DB_HOST';
        } else {
            $hostVariable = 'DB_' . $alternative . '_HOST';
        }

        $username = $this->get('DB_USERNAME');
        $hostname = $this->get($hostVariable);
        $password = $this->get('DB_PASSWORD');

        $databaseName = $this->get('DB_' . strtoupper($serviceNickname) . '_DATABASE');

        return 'pgsql:dbname=' . $databaseName . ';host=' . $hostname . ';user='.$username . ';password=' . $password;
    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function isDev(): bool
    {
        return $this->get('ENVIRONMENT') == 'dev';
    }

    private function fileContents(): array
    {
        if (!$this->settingsFileContents) {
            $this->settingsFileContents = $this->iniFileParser->parseIniFile($this->pathToSettingsFile);
        }
        return $this->settingsFileContents;
    }
}
