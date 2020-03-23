<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity', 'product_id', 'price', 'order_id'
    ];

    /**
     * Get product by order item
     */
    public function product()
    {
        return $this->belongsTo(Product::class)->select(['id', 'name', 'price', 'seller_name', 'ratings']);
    }
}
