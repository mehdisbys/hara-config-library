<?php
namespace Sainsburys\Hara\ConfigLibrary;

use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

interface Config
{
    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function get(string $settingName): string;

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function dsnForService(string $serviceNickname, string $alternative = null): string;

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function isDev(): bool;
}
