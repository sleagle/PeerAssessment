<?php


namespace App\Repository;


use Illuminate\Database\Connection;

class BaseRepository
{

    protected $connection;

    protected function __construct(Connection $connection)
    {
        $this->connection =  $connection;
    }
}
