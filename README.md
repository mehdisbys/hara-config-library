[![Circle CI](https://circleci.com/gh/JSainsburyPLC/hara-config-library.svg?style=svg&circle-token=892a821e48cb602ab7d904dcb9bd0742ec8f7e17)](https://circleci.com/gh/JSainsburyPLC/hara-config-library)

# HARA Config Library

Library for inclusion in all or most services.  Reads database passwords and other details out of the config file
at `/etc/.hara-env-vars`.


## Use in Production Code

Use a `Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile` object.  The interface for the class you will be using
contains this:

```php
public function get(string $settingName): string;
public function dsnForService(string $serviceNickname): string;
public function isDev(): bool;
```

The method `dsnForService()` returns Data Source Names, suitable for initialising PDO objects.


## Use in Test Automation

Use a `Sainsburys\Hara\ConfigLibrary\Config\FakeConfig` object.  In addition implementing the above methods, it also
has these:

```php
public function set(string $settingKey, string $settingValue);
public function setIsDev(bool $valToSet);
public function setDsn(string $dsnToSet);
```

You should use these methods to inject fake values into the config object, before anything tries to get them out again.


## Construction

Use the following from `Sainsburys\Hara\ConfigLibrary\Builder`:

```php
public function buildSecretConfigFile(string $pathToConfigFile): Config;
public function buildFakeConfigFile(): Config;
```
