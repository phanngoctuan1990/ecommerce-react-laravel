<?php

namespace App\Repositories\Products;

interface ProductsRepositoryInterface
{
    /**
     * Set product id
     *
     * @param string $id product id
     */
    public function setProductId(string $id);

    /**
     * Set product id
     *
     * @param string|null $category category name
     */
    public function setCategory($category);

    /**
     * Set product id
     *
     * @param string|null $keyword keyword
     */
    public function setKeyword($keyword);

    /**
     * Get product with image by id
     */
    public function getProductWithImageById();

    /**
     * Search products by category name and keyword
     */
    public function searchProductsByCategoryNameAndKeyword();
}
