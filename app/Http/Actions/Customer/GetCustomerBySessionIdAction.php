<?php

namespace App\Http\Actions\Customer;

use App\Models\Customer;
use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;

class GetCustomerBySessionIdAction
{
    public function handle(string $sessionId)
    {
        try {

            $customer = Customer::where('session_id', $sessionId)->first();

            return ResponseMessage::returnData(true, $customer);
        } catch (\Exception $exception) {

            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::GET_CUSTOMER_BY_SESSION_ID_ACTION_ERROR->value);

            return ResponseMessage::returnData(false);
        }
    }
}
