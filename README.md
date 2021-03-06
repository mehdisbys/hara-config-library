[![Circle CI](https://circleci.com/gh/JSainsburyPLC/hara-config-library.svg?style=svg&circle-token=892a821e48cb602ab7d904dcb9bd0742ec8f7e17)](https://circleci.com/gh/JSainsburyPLC/hara-config-library)

# HARA Config Library

Library for inclusion in all or most services.  Reads database passwords and other details out of the config file
at `/etc/.hara-env-vars`.


## Use in Production Code

Use a `Sainsburys\Hara\ConfigLibrary\Config\SecretConfigFile` object.  The interface for the class you will be using
contains this:

```php
public function get(string $settingName): string;
public function dsnForService(string $serviceNickname, string $alternative = null): string;
public function dsnComponentsForService(string $serviceNickname, string $alternative = null): array;
public function isDev(): bool;
```

### dsnForService
The method `dsnForService()` returns Data Source Names, suitable for initialising PDO objects.
The optional `$alternative` parameter is used to select a configuration key other than the default `"DB_HOST"`. If given, `$alternative` is inserted between `DB`and `HOST` with underscores separating the parts; e.g. supplying `$alternative = "AWS"` will use the host defined by the `"DB_AWS_HOST"` configuration key.

### dsnComponentsForService
Similarly, the method `dsnComponentsForService()` returns an array of each part of the Data Source Name, should the code require it. This is particularly useful for working with the Phinx migration library, which does not support using a DSN string. The arguments are identical to those for `dsnForService()` but an associative array is returned instead of a string.

The `adapter` key contains the `PDO` adapter required for the connection (e.g. "pgsql", "sqlite") and the rest of the array contains keys and values that would be defined in the DSN connection string.

For SQLite connections only the `path` key contains the path to the database. This will be ":memory:" if a memory connection has been specified.


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
