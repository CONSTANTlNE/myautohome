<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return   $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function application(){
        return   $this->belongsTo(Application::class, 'application_id', 'id');
    }

    public function potentialclients(){
        return   $this->belongsTo(PotentialClient::class, 'potentialclient_id', 'id');
    }
}
