<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSummary extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function orders(){
        return $this->hasMany(Order::class, 'no', 'order_number');
    }
}
