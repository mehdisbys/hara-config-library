<?php
namespace Sainsburys\Hara\ConfigLibrary\Dsns;

class DsnBuilder
{
    public function postgresDsn(string $database, string $hostname, string $username, string $password): string
    {
        return $this->getDsn('pgsql', $database, $hostname, $username, $password);
    }

    public function sqliteDsn(string $database, string $hostname, string $username, string $password): string
    {
        return $this->getDsn('sqlite', $database, $hostname, $username, $password);
    }

    private function getDsn(
        string $sqlFlavour,
        string $database,
        string $hostname,
        string $username,
        string $password
    ): string
    {
        return $sqlFlavour . ':dbname=' . $database . '_test;host=' . $hostname . ';user='.$username . ';password=' . $password;
    }
}
