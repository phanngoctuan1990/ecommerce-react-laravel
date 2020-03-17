<?php

namespace App\Repositories\Products;

use App\Product;

class ProductsRepository implements ProductsRepositoryInterface
{
    protected $product;
    protected $productId;

    /**
     * Construct ProductsRepository
     *
     * @param Product $model model
     *
     * @return void
     */
    public function __construct(Product $model)
    {
        $this->product = $model;
    }

    /**
     * Set product id
     *
     * @param string $id product id
     *
     * @return ProductsRepository
     */
    public function setProductId(string $id): ProductsRepository
    {
        $this->productId = $id;
        return $this;
    }

    /**
     * Set category
     *
     * @param string|null $category category
     *
     * @return ProductsRepository
     */
    public function setCategory($category): ProductsRepository
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Set keyword
     *
     * @param string|null $keyword keyword
     *
     * @return ProductsRepository
     */
    public function setKeyword($keyword): ProductsRepository
    {
        $this->keyword = $keyword;
        return $this;
    }

    /**
     * Get product with image by id
     *
     * @return Product|null
     */
    public function getProductWithImageById()
    {
        return $this->product
            ->with('image')
            ->find($this->productId);
    }

    /**
     * Search products by category name and keyword
     *
     * @return Collection
     */
    public function searchProductsByCategoryNameAndKeyword()
    {
        return $this->product->with(['image'])
            ->when($this->category, function ($query) {
                return $query->whereHas('category', function ($query) {
                    return $query->where('name', $this->category);
                });
            })
            ->when($this->keyword, function ($query) {
                return $query->where('name', 'LIKE', '%' . $this->keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $this->keyword . '%');
            })
            ->get();
    }
}
