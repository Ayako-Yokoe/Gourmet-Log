<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // public function restaurants(){
    //     return $this->belongsToMany('App\Models\Restautant', 'category_tags', 'restaurant_id', 'category_id');
    // }


    public function restaurants(){
        return $this->belongsToMany(Restaurant::class, 'category_tags');
    }
}
