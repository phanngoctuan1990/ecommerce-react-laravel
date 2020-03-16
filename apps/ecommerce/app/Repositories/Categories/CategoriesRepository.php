<?php

namespace App\Repositories\Categories;

use App\Category;

class CategoriesRepository implements CategoriesRepositoryInterface
{
    protected $category;
    protected $subCategory;

    /**
     * Construct CategoriesRepository
     *
     * @param Category $model model
     *
     * @return void
     */
    public function __construct(Category $model)
    {
        $this->category = $model;
    }

    /**
     * Set sub categories
     *
     * @param string $subCategory sub category
     *
     * @return CategoriesRepository
     */
    public function setSubCategory(string $subCategory): CategoriesRepository
    {
        $this->subCategory = $subCategory;
        return $this;
    }

    /**
     * Get first category by sub category name
     *
     * @return Category|null
     */
    public function firstBySubCategory()
    {
        return $this->category
            ->where('sub_category', $this->subCategory)
            ->first();
    }
}
