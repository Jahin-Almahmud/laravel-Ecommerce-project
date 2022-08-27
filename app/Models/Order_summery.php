<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_summery extends Model
{
    protected $fillable = [
        'payment_status',

    ];

    use HasFactory;
}
