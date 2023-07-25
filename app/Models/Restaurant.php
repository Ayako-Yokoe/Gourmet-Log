<?php

namespace App\Models;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [ 'deleted_at '];

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

    // Relationship with Categories
    public function categories(){
        return $this->belongsToMany(Category::class, 'category_tags');
    }

    // Relationship with User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
