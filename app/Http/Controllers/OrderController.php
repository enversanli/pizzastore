<?php

namespace App\Http\Controllers;

use App\Http\Actions\Customer\GetCustomerBySessionIdAction;
use App\Http\Actions\Customer\StoreCustomerAction;
use App\Http\Actions\CustomerAddress\StoreCustomerAddressAction;
use App\Http\Actions\Order\GetCustomerOrdersAction;
use App\Http\Actions\Order\GetOrderByOrderNumberAction;
use App\Http\Actions\Order\StoreOrderAction;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderSummaryResource;
use App\Support\ResponseMessage;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** @var StoreOrderAction */
    protected $storeOrderAction;

    /** @var StoreCustomerAction */
    protected $storeCustomerAction;

    /** @var GetCustomerOrdersAction */
    protected $getCustomerOrdersAction;

    /** @var StoreCustomerAddressAction */
    protected $storeCustomerAddressAction;

    /** @var GetCustomerBySessionIdAction */
    protected $getCustomerBySessionIdAction;

    /** @var GetOrderByOrderNumberAction */
    protected $getOrderByOrderNumberAction;

    public function __construct(
        StoreOrderAction             $storeOrderAction,
        StoreCustomerAction          $storeCustomerAction,
        GetCustomerOrdersAction      $getCustomerOrdersAction,
        StoreCustomerAddressAction   $storeCustomerAddressAction,
        GetOrderByOrderNumberAction  $getOrderByOrderNumberAction,
        GetCustomerBySessionIdAction $getCustomerBySessionIdAction,
    )
    {
        $this->storeOrderAction = $storeOrderAction;
        $this->storeCustomerAction = $storeCustomerAction;
        $this->getCustomerOrdersAction = $getCustomerOrdersAction;
        $this->storeCustomerAddressAction = $storeCustomerAddressAction;
        $this->getOrderByOrderNumberAction = $getOrderByOrderNumberAction;
        $this->getCustomerBySessionIdAction = $getCustomerBySessionIdAction;

    }

    public function index()
    {
        $customer = $this->getCustomerBySessionIdAction->handle(session_id());

        if (!$customer->status) {
            return ResponseMessage::failed($customer->message);
        }

        $orders = $this->getCustomerOrdersAction->handle($customer->data);

        if (!$orders->status)
            return ResponseMessage::failed($orders->message);

        return ResponseMessage::success('Success', OrderSummaryResource::collection($orders->data));
    }

    public function show($orderNumber)
    {
        $customer = $this->getCustomerBySessionIdAction->handle(session_id());

        if (!$customer->status) {
            return ResponseMessage::failed($customer->message);
        }

        $order = $this->getOrderByOrderNumberAction->handle($orderNumber, $customer->data);

        if (!$order->status)
            return ResponseMessage::failed($order->message);

        if (!$order->data)
            return ResponseMessage::failed($order->message);

        return ResponseMessage::success('Success', OrderSummaryResource::collection($order->data));
    }

    public function store(StoreOrderRequest $request)
    {
        // Check customer
        $customer = $this->getCustomerBySessionIdAction->handle(session_id());
        $newCustomer = false;

        if (!$customer->status) {
            return ResponseMessage::failed($customer->message);
        }

        // If customer not exist, create a new one
        if (!$customer->data) {
            $customer = $this->storeCustomerAction->execute($request);
            $newCustomer = true;
        }

        // if new customer created but faced an error
        if ($newCustomer && !$customer->status) {
            return ResponseMessage::failed($customer->message);
        }

        $storedAddress = $this->storeCustomerAddressAction->execute($request, $customer->data);

        if (!$storedAddress->status)
            return ResponseMessage::failed($storedAddress->message);

        // Create order
        $storedOrder = $this->storeOrderAction->execute($request, $customer->data, $storedAddress->data);

        if (!$storedOrder->status) {
            return ResponseMessage::failed($storedOrder->message);
        }

        return ResponseMessage::success('Your order has been accepted', ['url' => $this->createOrderUrl($storedOrder->data)]);
    }


    private function createOrderUrl($order)
    {
        return route('order.single', $order->order_number);
    }
}
