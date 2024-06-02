<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotentialStatus extends Model
{
    use HasFactory;


    public function potentialclients()
    {
        return $this->hasMany(PotentialClient::class);
    }
}
