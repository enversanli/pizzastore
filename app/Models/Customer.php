<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function orderSummaries(){
        return $this->hasMany(OrderSummary::class, 'customer_id', 'id');
    }

}
