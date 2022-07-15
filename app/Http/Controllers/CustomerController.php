<?php

namespace App\Http\Controllers;

use App\Http\Actions\Customer\GetCustomerBySessionIdAction;
use App\Http\Resources\CustomerResource;
use App\Support\ResponseMessage;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /** @var GetCustomerBySessionIdAction */
    protected $getCustomerBySessionIdAction;

    public function __construct(GetCustomerBySessionIdAction $getCustomerBySessionIdAction){
        $this->getCustomerBySessionIdAction = $getCustomerBySessionIdAction;
    }

    public function me(){

        $customer = $this->getCustomerBySessionIdAction->handle(session_id());

        if (!$customer->status)
            return ResponseMessage::failed($customer->message);

        return ResponseMessage::success('Success', CustomerResource::make($customer->data));
    }
}
