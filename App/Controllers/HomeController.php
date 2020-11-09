<?php

namespace App\Controllers;

use App\Lib\Request;
use App\Lib\Response;
use App\Models\User;

class HomeController
{
    public function index()
    {
        echo "Home Controller";
    }

    public function user(Request $req, Response $res)
    {
        $users = (new User())->get();
        return $res->toJSON($users);
    }
}