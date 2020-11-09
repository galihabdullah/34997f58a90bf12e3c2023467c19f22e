<?php
namespace App;

use App\Lib\Database;
use App\Lib\Logger;


class App
{

    public static function run()
    {
        Logger::enableSystemLogs();
//        Database::getInstance();
    }
}