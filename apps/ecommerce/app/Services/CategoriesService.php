<?php

namespace App\Services;

use App\Repositories\Categories\CategoriesRepositoryInterface;

class CategoriesService  extends BaseService
{
    protected $subCategory;
    protected $categoryRepo;

    /**
     * Create a new controller instance.
     *
     * @param CategoriesRepositoryInterface $categoryRepo category repository
     *
     * @return void
     */
    public function __construct(CategoriesRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Set sub category
     *
     * @param string $subCategory sub category
     *
     * @return CategoriesService
     */
    public function setSubCategory(string $subCategory): CategoriesService
    {
        $this->subCategory = $subCategory;
        return $this;
    }

    /**
     * Get products by sub category
     *
     * @return array
     */
    public function getProductsBySubcategory(): array
    {
        $category = $this->categoryRepo
            ->setSubCategory($this->subCategory)
            ->firstBySubCategory();

        $products = [
            'featured' => [],
            'new_arrivals' => [],
        ];

        if ($category) {
            $products['featured'] = $category->featured->load('image');
            $products['new_arrivals'] = $category->new_arrivals->load('image');
        }

        return $products;
    }
}
