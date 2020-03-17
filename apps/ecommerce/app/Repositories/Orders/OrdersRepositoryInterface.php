<?php

namespace App\Repositories\Orders;

interface OrdersRepositoryInterface
{
    /**
     * Set order data
     *
     * @param array $data order data
     */
    public function setOrderData(array $data);

    /**
     * Store order
     */
    public function store();
}
