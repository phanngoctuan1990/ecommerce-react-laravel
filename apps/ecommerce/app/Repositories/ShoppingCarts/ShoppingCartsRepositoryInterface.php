<?php

namespace App\Repositories\ShoppingCarts;

interface ShoppingCartsRepositoryInterface
{
    /**
     * Set user id
     *
     * @param int $userId user id
     */
    public function setUserId(int $userId);

    /**
     * Set shopping cart id
     *
     * @param int $id shopping cart id
     */
    public function setShoppingCartId(int $id);

    /**
     * Set shopping cart data
     *
     * @param array $data shopping cart data
     */
    public function setShoppingCartData(array $data);

    /**
     * Set wish list
     *
     * @param bool $wishList wish list
     */
    public function setWishList(bool $wishList);

    /**
     * Set products id
     *
     * @param array $productsId products id
     */
    public function setProductsId(array $productsId);

    /**
     * Set conditions
     *
     * @param array $conditions conditions
     */
    public function setConditions(array $conditions);

    /**
     * Delete by conditions
     */
    public function deleteByConditions();

    /**
     * Update shopping cart by products id, wish list, user id
     */
    public function updateByProductsIdWishListUserId();

    /**
     * Update shopping cart by id
     */
    public function updateById();

    /**
     * First or create
     */
    public function firstOrCreate();
}
