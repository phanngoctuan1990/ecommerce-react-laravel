<?php

namespace App\Services;

use App\Product;
use App\Exceptions\ApiException;
use App\Repositories\Products\ProductsRepositoryInterface;

class ProductsService extends BaseService
{
    protected $request;
    protected $productId;
    protected $productsRepo;

    /**
     * Create a new controller instance.
     *
     * @param ProductsRepositoryInterface $productsRepo product repository
     *
     * @return void
     */
    public function __construct(ProductsRepositoryInterface $productsRepo)
    {
        $this->productsRepo = $productsRepo;
    }

    /**
     * Set product id
     *
     * @param string id product id
     *
     * @return ProductsService
     */
    public function setProductId(string $id): ProductsService
    {
        $this->productId = $id;
        return $this;
    }

    /**
     * Set request
     *
     * @param Request request request
     *
     * @return ProductsService
     */
    public function setRequest($request): ProductsService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Search products by category name and keyword
     *
     * @return Collection
     */
    public function searchProductsByCategoryNameAndKeyword()
    {
        $category = null;
        if ($this->request->category && $this->request->category !== 'all') {
            $category = $this->request->category;
        }

        return $this->productsRepo
            ->setCategory($category)
            ->setkeyword($this->request->keyword)
            ->searchProductsByCategoryNameAndKeyword();
    }

    /**
     * Get product with image by id
     *
     * @return Product|ApiException
     */
    public function getProductWithImageById()
    {
        $product = $this->productsRepo
            ->setProductId($this->productId)
            ->getProductWithImageById();

        if (!$product) {
            throw new ApiException('Product not found', 404);
        }

        return $product;
    }
}
