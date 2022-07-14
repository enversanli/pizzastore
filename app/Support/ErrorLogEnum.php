<?php

namespace App\Support;

enum ErrorLogEnum:string
{
    // Products
    case GET_PRODUCTS_ERROR = 'GET_PRODUCTS_ERROR';

    // Order
    case STORE_ORDER_ACTION_ERROR = 'STORE_ORDER_ACTION_ERROR';
}
