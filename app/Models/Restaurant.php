<?php

namespace App\Models;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name', 
        'name_katakana', 
        'review', 
        'food_picture', 
        'map_url', 
        'phone_number', 
        'comment'
    ];

    // public function categories(){
    //     return $this->belongsToMany('App\Models\Category', 'category_tags', 'category_id', 'restaurant_id');
    // }

    // Relationship with Categories
    public function categories(){
        return $this->belongsToMany(Category::class, 'category_tags');
    }

    // Relationship with User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
