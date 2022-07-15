<?php

namespace App\Http\Actions\Order;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderSummary;
use App\Models\Product;
use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;

class StoreOrderAction
{
    public function execute(StoreOrderRequest $request, Customer $customer, CustomerAddress $customerAddress)
    {
        try {
            $orderNo = $this->createOrderNumber();
            $total = 0;
            foreach ($request->orders as $row) {
                $product = Product::find($row['id']);
                Order::create([
                    'no' => $orderNo,
                    'customer_id' => $customer->id,
                    'customer_address_id' => $customerAddress->id,
                    'product_id' => $row['id'],
                    'piece' => $row['count'] ?? 1,
                ]);

                $total += (int)$row['count'] * $product->price;
            }

            $summary = OrderSummary::create([
                'customer_id' =>  $customer->id,
                'order_number' =>  $orderNo,
                'total' => $total,
                'delivery_fee' => $this->calculateDeliveryFee($total)
            ]);

            return ResponseMessage::returnData(true, $summary);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::STORE_ORDER_ACTION_ERROR->value);
            return ResponseMessage::returnData(false);
        }
    }

    public function calculateDeliveryFee(int $total){
        if ($total > 15){
            return 0;
        }

        return 15;
    }

    private function createOrderNumber(){

        while (true){
            $orderNumber = rand(999, 99999);
            $order = Order::where('no', $orderNumber)->first();

            if (!$order)
                return $orderNumber;
        }
    }
}
