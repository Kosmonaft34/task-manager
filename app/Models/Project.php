<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table='projects';
    protected $fillable = ['id', 'created_at', 'updated_at', 'name'];

    public function tasks(){
        return $this->belongsToMany(Task::class);
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
}
