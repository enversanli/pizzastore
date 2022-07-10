<?php

namespace App\Http\Actions\Product;

use App\Models\Product;
use App\Support\ResponseMessage;

class GetProductsAction
{
    public function get(){
        try {

            $products = Product::all();

            return ResponseMessage::returnData(true, $products);

        }catch (\Exception $exception){
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log('PRODUCT_');
        }
    }
}
