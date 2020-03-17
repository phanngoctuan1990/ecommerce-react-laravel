<?php

namespace App\Repositories\Orders;

use App\Order;

class OrdersRepository implements OrdersRepositoryInterface
{
    protected $order;
    protected $orderData;

    /**
     * Construct OrdersRepository
     *
     * @param Order $model model
     *
     * @return void
     */
    public function __construct(Order $model)
    {
        $this->order = $model;
    }

    /**
     * Set order data
     *
     * @param array $data order data
     *
     * @return OrdersRepository
     */
    public function setOrderData(array $data): OrdersRepository
    {
        $this->orderData = $data;
        return $this;
    }

    /**
     * Store order
     *
     * @return Order
     */
    public function store(): Order
    {
        return $this->order->create($this->orderData);
    }
}
