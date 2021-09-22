<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable = ['title','preview_text','detail_text'];

    public function minis()
    {
        return $this->hasMany(Mini::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
