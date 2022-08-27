<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_image'
    ];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    use HasFactory;
}
