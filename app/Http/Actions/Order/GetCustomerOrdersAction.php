<?php

namespace App\Http\Actions\Order;

use App\Models\Customer;
use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;

class GetCustomerOrdersAction
{
    public function handle(Customer $customer){
        try {
            $orders = $customer->orderSummaries()->with('orders')->paginate(999);

            return  ResponseMessage::returnData(true, $orders);

        }catch (\Exception $exception){
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::GET_CUSTOMER_ORDERS_ACTION_ERROR->value);

            return ResponseMessage::returnData(false);
        }
    }
}
