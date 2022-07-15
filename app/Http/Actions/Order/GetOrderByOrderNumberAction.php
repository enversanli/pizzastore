<?php

namespace App\Http\Actions\Order;

use App\Models\Customer;
use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;

class GetOrderByOrderNumberAction
{
    public function handle($orderNumber, Customer $customer){
        try {
            $order = $customer->orderSummaries()
                ->where('order_number', $orderNumber)
                ->with('orders')
                ->first();

            if (!$order)
                return ResponseMessage::returnData(true, null, 'Order cannot be found.');

            return  ResponseMessage::returnData(true, $order);

        }catch (\Exception $exception){
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::GET_CUSTOMER_ORDERS_ACTION_ERROR->value);

            return ResponseMessage::returnData(false);
        }
    }
}
