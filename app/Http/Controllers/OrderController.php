<?php

namespace App\Http\Controllers;

use App\Http\Actions\Order\StoreOrderAction;
use App\Http\Requests\StoreOrderRequest;
use App\Support\ResponseMessage;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** @var StoreOrderAction */
    protected $storeOrderAction;

    public function __construct(StoreOrderAction $storeOrderAction)
    {
        $this->storeOrderAction = $storeOrderAction;
    }

    public function index()
    {

    }

    public function store(StoreOrderRequest $request)
    {
        $storedOrder = $this->storeOrderAction->execute($request);

        if ($storedOrder->status) {
            return ResponseMessage::failed($storedOrder->message);
        }

        return ResponseMessage::success('Your order has been accepted');
    }
}
