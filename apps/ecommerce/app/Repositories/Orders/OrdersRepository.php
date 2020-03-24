<?php

namespace App\Repositories\Orders;

use App\Order;

class OrdersRepository implements OrdersRepositoryInterface
{
    protected $order;
    protected $userId;
    protected $orderId;
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
     * Set order id
     *
     * @param int $orderId order id
     */
    public function setOrderId(int $orderId): OrdersRepository
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * Set user id
     *
     * @param int $userId user id
     */
    public function setUserId(int $userId): OrdersRepository
    {
        $this->userId = $userId;
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

    /**
     * Get order by id and user id
     *
     * @return Order|null
     */
    public function getOrderByIdAndUserId()
    {
        return $this->order
            ->whereId($this->orderId)
            ->whereUserId($this->userId)
            ->with([
                'promoCode',
                'orderItems.product.image',
                'payment.paymentMethodData',
            ])
            ->first();
    }
}
