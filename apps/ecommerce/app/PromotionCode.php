<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotion_codes';

    /**
     * Get user promotion code by promotion code
     */
    public function userPromotionCodes()
    {
        return $this->hasMany(UserPromotionCode::class);
    }
}
