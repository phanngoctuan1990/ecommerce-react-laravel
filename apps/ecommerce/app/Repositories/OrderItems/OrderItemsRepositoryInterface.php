<?php

namespace App\Repositories\OrderItems;

interface OrderItemsRepositoryInterface
{
    /**
     * Set order item data
     *
     * @param array $data order data
     */
    public function setOrderItemData(array $data);

    /**
     * Store order item
     */
    public function store();
}
