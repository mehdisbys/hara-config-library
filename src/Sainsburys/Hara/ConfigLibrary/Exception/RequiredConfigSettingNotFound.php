<?php
namespace Sainsburys\Hara\ConfigLibrary\Exception;

class RequiredConfigSettingNotFound extends \RuntimeException implements ConfigLibraryException
{
    public static function constructWithSettingKey(string $settingKey)
    {
        return new static("The config file setting '$settingKey' does not exist");
    }
}
