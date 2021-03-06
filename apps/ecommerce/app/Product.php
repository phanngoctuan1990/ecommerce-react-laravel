<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Get image by product
     */
    public function image()
    {
        return $this->hasOne(Image::class)->withDefault();
    }

    /**
     * Get category by product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
