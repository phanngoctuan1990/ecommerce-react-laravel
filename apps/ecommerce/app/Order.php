<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_date', 'total_amount', 'payment_id', 'user_id', 'shipping_option_id', 'promotion_code_id',
    ];

    /**
     * Get order items by order
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class)->select(['id', 'order_id', 'quantity', 'product_id', 'price']);
    }
}
