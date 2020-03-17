<?php

namespace App\Repositories\ShoppingCarts;

use App\ShoppingCart;

class ShoppingCartsRepository implements ShoppingCartsRepositoryInterface
{
    protected $id;
    protected $userId;
    protected $wishList;
    protected $conditions;
    protected $productsId;
    protected $shoppingCart;
    protected $shoppingCartData;

    /**
     * Construct ShoppingCartsRepository
     *
     * @param ShoppingCart $model model
     *
     * @return void
     */
    public function __construct(ShoppingCart $model)
    {
        $this->shoppingCart = $model;
    }

    /**
     * Set shopping cart data
     *
     * @param array $data data
     *
     * @return ShoppingCartsRepository
     */
    public function setShoppingCartData(array $data): ShoppingCartsRepository
    {
        $this->shoppingCartData = $data;
        return $this;
    }

    /**
     * Set shopping cart id
     *
     * @param int $id shopping cart id
     */
    public function setShoppingCartId(int $id): ShoppingCartsRepository
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set user id
     *
     * @param int $userId user id
     *
     * @return ShoppingCartsRepository
     */
    public function setUserId(int $userId): ShoppingCartsRepository
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Set wish list
     *
     * @param bool $wishList wish list
     *
     * @return ShoppingCartsRepository
     */
    public function setWishList(bool $wishList): ShoppingCartsRepository
    {
        $this->wishList = $wishList;
        return $this;
    }

    /**
     * Set products id
     *
     * @param array $productsId products id
     *
     * @return ShoppingCartsRepository
     */
    public function setProductsId(array $productsId): ShoppingCartsRepository
    {
        $this->productsId = $productsId;
        return $this;
    }

    /**
     * Set conditions
     *
     * @param array $conditions conditions
     *
     * @return ShoppingCartsRepository
     */
    public function setConditions(array $conditions): ShoppingCartsRepository
    {
        $this->conditions = $conditions;
        return $this;
    }

    /**
     * Delete by conditions
     *
     * @return bool
     */
    public function deleteByConditions(): bool
    {
        return $this->shoppingCart->where($this->conditions)->delete();
    }

    /**
     * Update shopping cart by products id, wish list, user id
     *
     * @return bool
     */
    public function updateByProductsIdWishListUserId(): bool
    {
        return $this->shoppingCart
            ->whereUserId($this->userId)
            ->whereWishList($this->wishList)
            ->whereIn('product_id', $this->productsId)
            ->update($this->shoppingCartData);
    }

    /**
     * First or create
     *
     * @return ShoppingCart
     */
    public function firstOrCreate(): ShoppingCart
    {
        return $this->shoppingCart->firstOrCreate($this->shoppingCartData);
    }

    /**
     * Update by id
     *
     * @return bool
     */
    public function updateById(): bool
    {
        return $this->shoppingCart
            ->whereId($this->id)
            ->update($this->shoppingCartData);
    }
}
