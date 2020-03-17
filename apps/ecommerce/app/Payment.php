<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const SUCCESS_TYPE = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'status', 'time_stamp', 'payment_method_id'
    ];
}
