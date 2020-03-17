<?php

namespace App\Repositories\Categories;

use App\Category;

interface CategoriesRepositoryInterface
{
    /**
     * Set sub categories
     *
     * @param string $subCategory sub category
     */
    public function setSubCategory(string $subCategory);

    /**
     * Set category
     *
     * @param Category $category category
     */
    public function setCategory(Category $category);

    /**
     * Get category by sub_category
     */
    public function firstBySubCategory();

    /**
     * Get featured and new arrivals with image by category
     *
     * @return array
     */
    public function getFeaturedAndNewArrivalsWithImageByCategory();
}
