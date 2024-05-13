<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function companies(){
        return    $this->belongsToMany(Company::class);
    }

    public function client(){
        return   $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function source(){
        return   $this->belongsTo(Source::class, 'source_id', 'id');
    }

    public function status(){
        return   $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function product(){
        return  $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function car(){
        return    $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'id');
    }

    public function comments(){
        return  $this->hasMany(Comment::class, 'application_id', 'id');
    }
}
