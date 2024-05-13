<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;


    public function make(){
        return $this->belongsTo(Car::class);
    }

    public function applications ()
    {
        return $this->hasMany(Application::class);
    }
}
