<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_thumnail_image',
        'name',
        'slug',
        'product_description',
        'product_additional_infromation',
        'product_regular_price',
        'product_discount_price',
        'quantity',
        'product_image',
        'status',
        'user_id'
    ];
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function thumnailphotos()
    {
        return $this->hasMany(Thumnail_image::class);
    }
    use HasFactory;
}
