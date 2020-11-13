<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Emails extends Model
{
    protected $fillable = ['to_email', 'title','message','id_user', 'status'];
    protected $table ="emails";
}