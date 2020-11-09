<?php

require __DIR__."/vendor/autoload.php";

use App\App;
use App\Controllers\HomeController;
use App\Lib\Config;
use App\Lib\Logger;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;


Router::get('/', function (Request $req, Response $res){
    (new HomeController())->index();
});

Router::get('/user', function (Request $req, Response $res){
    (new HomeController())->user($req, $res);
});
//Router::get('/post/([0-9])*', function (Request $req, Response $res){
//    $res->toJSON([
//        'post' => [$req->params[0]],
//        'status' => 'ok'
//    ]);
//});


App::run();
