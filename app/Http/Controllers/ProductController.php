<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Support\ResponseMessage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all();

        if (!$products->status)
            return ResponseMessage::success();

        return ResponseMessage::success(null, ProductResource::collection($products->data));
    }
}
