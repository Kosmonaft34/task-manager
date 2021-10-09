<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mini extends Model
{
    use HasFactory;
    protected $table = 'minis';
    protected $fillable = ['text'];
    public $timestamps = false; //чтобы не записывал данные в updated_at и created_add

    public function task(){
        return $this->belongsTo(Task::class );
    }
}
