<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;

    protected $table = 'users'; //на какую таблицу будет смотреть модель

    protected $fillable =['name','email','password'];
}
