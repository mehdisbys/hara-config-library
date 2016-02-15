<?php
namespace Sainsburys\Hara\ConfigLibrary\Dsns;

class DsnBuilder
{
    public function postgresDsn(string $database, string $hostname, string $username, string $password): string
    {
        return 'pgsql:dbname=' . $database . ';host=' . $hostname . ';user='.$username . ';password=' . $password;
    }
}
