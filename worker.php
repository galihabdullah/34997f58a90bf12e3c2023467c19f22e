<?php
require __DIR__."/vendor/autoload.php";

use App\Consumer;


\App\App::run();
try{
    (new Consumer(['queue' => "sendEmail"]))->listen();
    echo "Listen beanstalk";
}catch (Exception $e){
    echo $e->getMessage();
}
