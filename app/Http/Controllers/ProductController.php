<?php

namespace App\Http\Controllers;

use App\Http\Actions\Product\GetProductsAction;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Support\ResponseMessage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** @var GetProductsAction */
    protected $getProductsAction;

    public function __construct(GetProductsAction $getProductsAction){
        $this->getProductsAction = $getProductsAction;
    }

    public function index(){

        $products = $this->getProductsAction->get();

        if (!$products->status)
            return ResponseMessage::success();

        return ResponseMessage::success(null, ProductResource::collection($products->data));
    }
}
