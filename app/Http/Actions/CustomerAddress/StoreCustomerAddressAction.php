<?php

namespace App\Http\Actions\CustomerAddress;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Support\ErrorLogEnum;
use App\Support\ResponseMessage;
use Illuminate\Http\Request;

class StoreCustomerAddressAction
{
    public function execute(Request$request, Customer $customer){
        try {

            $address = CustomerAddress::where('customer_id', $customer->id)
                ->where('phone', $request->customer['phone'])
                ->where('address', $request->customer['address'])
                ->first();

            if ($address)
                return ResponseMessage::returnData(true, $address);

            $address = CustomerAddress::create([
                'customer_id' => $customer->id,
                'phone' => $request->customer['phone'],
                'address' => $request->customer['address'],
            ]);

            return ResponseMessage::returnData(true, $address);
        }catch (\Exception $exception){
            dd($exception->getMessage());
            activity()
                ->withProperties(['error' => $exception->getMessage()])
                ->log(ErrorLogEnum::STORE_CUSTOMER_ADDRESS_ACTION_ERROR->value);

            return ResponseMessage::returnData(false);
        }
    }
}
