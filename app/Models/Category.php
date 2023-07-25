<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
        'name'
    ];

    public function restaurants(){
        return $this->belongsToMany(Restaurant::class, 'category_tags');
    }
}
