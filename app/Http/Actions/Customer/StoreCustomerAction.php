<?php

namespace App\Http\Actions\Customer;

use App\Models\Customer;
use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;

class StoreCustomerAction
{
    public function execute($request){

        try {
            $customer = Customer::create([
                'session_id' => session_id(),
                'full_name' => $request->customer['full_name'],
                'phone' => $request->customer['phone'],
                'address' => $request->customer['address']
            ]);

            return ResponseMessage::returnData(true, $customer);
        }catch (\Exception $exception){
            dd($exception->getMessage());
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::STORE_CUSTOMER_ACTION_ERROR->value);
            return ResponseMessage::returnData(false);
        }
    }
}
