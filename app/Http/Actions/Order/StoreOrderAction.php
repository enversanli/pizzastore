<?php

namespace App\Http\Actions\Order;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;

class StoreOrderAction
{
    public function execute(StoreOrderRequest $request)
    {
        try {
            foreach ($request->all() as $row) {
                Order::create([
                    'product_id' => $row['id'],
                    'piece' => $row['piece'] ?? 1,
                    'address' => $row['address'] ?? null
                ]);
            }

            return ResponseMessage::returnData();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::STORE_ORDER_ACTION_ERROR->value);
            return ResponseMessage::returnData(false);
        }
    }
}
