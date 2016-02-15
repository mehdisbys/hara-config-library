<?php
namespace Sainsburys\Hara\ConfigLibrary\Config;

use Sainsburys\Hara\ConfigLibrary\Config;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

class FakeConfig implements Config
{
    private $basicSettings = [];

    public function set(string $settingKey, string $settingValue)
    {
        $this->basicSettings[$settingKey] = $settingValue;
    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function get(string $settingName): string
    {
        if (!isset($this->basicSettings[$settingName])) {
            throw RequiredConfigSettingNotFound::constructWithSettingKey($settingName);
        }
        return $this->basicSettings[$settingName];
    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function dsnForService(string $serviceNickname): string
    {

    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function isDev(): bool
    {

    }
}
