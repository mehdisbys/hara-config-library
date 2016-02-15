<?php
namespace Sainsburys\Hara\ConfigLibrary\Config;

use Sainsburys\Hara\ConfigLibrary\Exception\RequiredConfigSettingNotFound;

class SecretConfigFile
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
    public function postgresDsn(string $serviceNickname): string
    {

    }

    /**
     * @throws RequiredConfigSettingNotFound
     */
    public function sqliteDsn(string $serviceNickname): string
    {

    }
}
