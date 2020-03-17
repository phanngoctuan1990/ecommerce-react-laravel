<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPromotionCode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_promotion_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'promotion_code_id'
    ];
}
