<?php


namespace App\Lib;


use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class Database
{
    protected $conn;

    public function __construct()
    {
        $env = parse_ini_file( __DIR__."/../../.env");
        $params = [
            'user' => $env['DB_USER'],
            'password' => $env['DB_PASSWORD'],
            'host' => $env['DB_HOST'],
            'driver' => 'pdo_pgsql',
            'default_dbname' => $env['DB_DATABASE']
        ];
        try {
            $this->conn = DriverManager::getConnection($params);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

}