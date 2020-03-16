<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Services\CategoriesService;

class CategoryController extends BaseApiController
{
    protected $categoriesService;

    /**
     * Create a new controller instance.
     *
     * @param CategoriesService $categoriesService categories service
     *
     * @return void
     */
    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    /**
     * Get sub category by category name
     *
     * @param string category category name
     *
     * @return json
     */
    public function subCategories($category)
    {
        return $this->sendResponse(
            Category::subCategories($category)
        );
    }

    /**
     * Get products by sub category name
     *
     * @param string $subcategory sub category
     *
     * @return json
     */
    public function getProductsBySubcategory(string $subcategory)
    {
        $products = $this->categoriesService
            ->setSubCategory($subcategory)
            ->getProductsBySubcategory();

        return $this->sendResponse($products);
    }
}
