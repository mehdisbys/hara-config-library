<?php
namespace Sainsburys\Hara\ConfigLibrary\Exception;

class RequiredConfigSettingNotFound extends \RuntimeException implements ConfigLibraryException
{
    public static function constructWithSettingKey(string $settingKey)
    {
        return new static("The config file setting '$settingKey' does not exist");
    }

    public static function constructWithMethodCallRecommendation(string $nameOfMethodToCall)
    {
        return new static("Config setting missing - call '$nameOfMethodToCall' on config object first");
    }
}
