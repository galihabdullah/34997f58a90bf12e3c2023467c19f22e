<?php

namespace App\Models;

use App\Lib\Database;
use Doctrine\DBAL\Exception;

class User extends Database
{
//    protected $conn;

    protected $fillable = [
      'username' => null,
        'password' => null
    ];


    public function get()
    {
        try {
            $sql = "SELECT * FROM public.user";
            return $this->conn->fetchAllAssociative($sql);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}