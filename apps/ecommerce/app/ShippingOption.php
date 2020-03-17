<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{
    const ORDER_PLACED = 1;
    const SHIPPED = 2;
    const IN_TRANSIT = 3;
    const DELIVERED = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipping_options';
}
