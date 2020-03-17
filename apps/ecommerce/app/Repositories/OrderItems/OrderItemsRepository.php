<?php

namespace App\Repositories\OrderItems;

use App\OrderItem;

class OrderItemsRepository implements OrderItemsRepositoryInterface
{
    protected $orderItem;
    protected $orderItemData;

    /**
     * Construct OrderItemsRepository
     *
     * @param OrderItem $model model
     *
     * @return void
     */
    public function __construct(OrderItem $model)
    {
        $this->orderItem = $model;
    }

    /**
     * Set order item data
     *
     * @param array $data order data
     *
     * @return OrderItemsRepository
     */
    public function setOrderItemData(array $data): OrderItemsRepository
    {
        $this->orderItemData = $data;
        return $this;
    }

    /**
     * Store order item
     *
     * @return OrderItem
     */
    public function store(): OrderItem
    {
        return $this->orderItem->create($this->orderItemData);
    }
}
