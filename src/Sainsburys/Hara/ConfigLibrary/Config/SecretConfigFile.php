<?php
namespace Sainsburys\Hara\ConfigLibrary\Config;

use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

class SecretConfigFile
{
    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function get(string $settingName): string
    {

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
}
