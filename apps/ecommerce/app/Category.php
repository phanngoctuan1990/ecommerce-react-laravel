<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const SUB_CATEGORIES = [
        'books' => ['Book', 'Novel', 'Magazine'],
        'electronics' => ['TV', 'Cellphone', 'Camera', 'Laptops'],
        'homerequirements' => ['Furniture', 'Lighting', 'Mattress'],
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Get sub categories by category name.
     *
     * @param string $categoryName category name
     *
     * @return array
     */
    public static function subCategories(string $categoryName): array
    {
        try {
            return self::SUB_CATEGORIES[strtolower($categoryName)];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get product by category id
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get new arrivals by category
     */
    public function new_arrivals()
    {
        return $this->products()->orderBy('time_stamp', 'desc')->limit(10);
    }

    /**
     * Get feature by category
     */
    public function featured()
    {
        return $this->products()->orderBy('ratings', 'desc')->limit(10);
    }
}
