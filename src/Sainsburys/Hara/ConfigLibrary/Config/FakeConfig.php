<?php
namespace Sainsburys\Hara\ConfigLibrary\Config;

use Sainsburys\Hara\ConfigLibrary\Config;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

class FakeConfig implements Config
{
    /** @var string[] */
    private $basicSettings = [];

    /** @var bool */
    private $isDevSetting;

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
        if (!isset($this->isDevSetting)) {
            throw RequiredConfigSettingNotFound::constructWithMethodCallRecommendation('setIsDev');
        }
        return $this->isDevSetting;
    }

    public function setIsDev(bool $valToSet)
    {
        $this->isDevSetting = $valToSet;
    }
}
