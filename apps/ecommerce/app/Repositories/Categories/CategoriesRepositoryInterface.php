<?php

namespace App\Repositories\Categories;

interface CategoriesRepositoryInterface
{
    /**
     * Set sub categories
     *
     * @param string $subCategory sub category
     */
    public function setSubCategory(string $subCategory);

    /**
     * Get category by sub_category
     */
    public function firstBySubCategory();
}
