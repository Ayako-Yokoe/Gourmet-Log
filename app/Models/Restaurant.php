<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'name_katakana', 
        'review', 
        'food_picture', 
        'map_url', 
        'phone_number', 
        'comment'
    ];
}
