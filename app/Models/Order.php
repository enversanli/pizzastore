<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function address(){
        return $this->hasOne(CustomerAddress::class, 'id', 'customer_address_id');
    }

    public function summary(){
        return $this->hasOne(OrderSummary::class, 'order_number', 'no');
    }
}
