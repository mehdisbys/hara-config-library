<?php
namespace Sainsburys\Hara\ConfigLibrary;

use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

interface Config
{
    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function setting(string $settingName): string;

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function dsnForService(string $serviceNickname): string;

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function isDev(): string;
}
