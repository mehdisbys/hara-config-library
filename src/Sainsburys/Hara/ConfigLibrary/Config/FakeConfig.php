<?php
namespace Sainsburys\Hara\ConfigLibrary\Config;

use Sainsburys\Hara\ConfigLibrary\Config;
use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

class FakeConfig implements Config
{
    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function setting(string $settingName): string
    {

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
    public function isDev(): string
    {

    }
}
