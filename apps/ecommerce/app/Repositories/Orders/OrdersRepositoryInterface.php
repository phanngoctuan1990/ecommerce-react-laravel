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
     * Set order id
     *
     * @param int $orderId order id
     */
    public function setOrderId(int $orderId);

    /**
     * Set user id
     *
     * @param int $userId user id
     */
    public function setUserId(int $userId);

    /**
     * Store order
     */
    public function store();

    /**
     * Get order by id and user id
     */
    public function getOrderByIdAndUserId();
}
