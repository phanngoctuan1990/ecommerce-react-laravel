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
     * Set category
     *
     * @param Category $category category
     *
     * @return CategoriesRepository
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
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

    /**
     * Get featured and new arrivals with image by category
     *
     * @return array
     */
    public function getFeaturedAndNewArrivalsWithImageByCategory(): array
    {
        return [
            'featured' => $this->category->featured->load('image'),
            'new_arrivals' => $this->category->new_arrivals->load('image'),
        ];
    }
}
