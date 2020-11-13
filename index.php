<?php

require __DIR__."/vendor/autoload.php";

use App\App;
use App\Controllers\HomeController;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

App::run();


Router::post('/login', function (Request $req, Response $res){
    (new HomeController())->login($req, $res);
});


Router::get('/docs', function (Request $req, Response $res){
    (new HomeController())->docs($req, $res);
});

Router::get('/json', function (Request $req, Response $res){
    (new HomeController())->docJson($req, $res);
});

Router::post('/send', function (Request $req, Response $res){
    (new HomeController())->sendEmail($req, $res);
});



