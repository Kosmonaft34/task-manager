<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable,HasFactory;
    protected $table = 'users'; //на какую таблицу будет смотреть модель

    protected $fillable =['name','email','password','Date_Birth', 'surname', 'patronymic'];
    public function tasks(){
        return $this->belongsToMany(Task::class);
}
}

