<?php

namespace App\Http\Controllers\Api;

use App\Services\OrdersService;
use App\Http\Requests\PlaceOrderRequest;
use App\Http\Controllers\Api\BaseApiController;

class OrderController extends BaseApiController
{
    protected $ordersService;

    /**
     * Create a new controller instance.
     *
     * @param OrdersService $ordersService orders service
     *
     * @return void
     */
    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    /**
     * Place order.
     *
     * @param PlaceOrderRequest $request request
     *
     * @return json
     */
    public function placeOrder(PlaceOrderRequest $request)
    {
        $this->ordersService->setRequest($request)->placeorder();
        return $this->sendResponse(['message' => 'order successfully placed']);
    }

    /**
     * Get user orders.
     *
     * @return json
     */
    public function getUserOrders()
    {
        $userOrders = $this->ordersService->getUserOrders();
        return $this->sendResponse($userOrders);
    }
}
