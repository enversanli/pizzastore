<?php

namespace App\Http\Actions\Order;

use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;

class GetOrdersAction
{
    public function handle(string $sessionId){
        try {

        }catch (\Exception $exception){
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::GET_ORDERS_ACTION_ERROR->value);

            return ResponseMessage::returnData(false);
        }
    }
}
