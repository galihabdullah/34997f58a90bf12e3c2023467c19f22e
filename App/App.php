<?php
namespace App;

use App\Lib\Logger;
use Illuminate\Database\Capsule\Manager;


class App
{

    public static function run()
    {
        $capsule = new Manager();
        $capsule->addConnection([
            'driver'    => 'pgsql',
            'host'      => 'db',
            'port' => '5432',
            'database'  => 'postgres',
            'username'  => 'postgresondocker',
            'password'  => 'postgresondocker',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'schema'    =>  'public'
        ]);
        $capsule->bootEloquent();
        $capsule->setAsGlobal();

    }
}