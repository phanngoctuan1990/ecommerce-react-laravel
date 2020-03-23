<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Wishlists\WishlistsRepositoryInterface;
use App\Repositories\ShoppingCarts\ShoppingCartsRepositoryInterface;

class WishlistsService extends BaseService
{
    protected $request;
    protected $productId;
    protected $wishlistRepo;
    protected $shoppingCartRepo;

    /**
     * Create a new controller instance.
     *
     * @param WishlistsRepositoryInterface     $wishlistRepo     wishlist repository
     * @param ShoppingCartsRepositoryInterface $shoppingCartRepo shopping cart repository
     *
     * @return void
     */
    public function __construct(
        WishlistsRepositoryInterface $wishlistRepo,
        ShoppingCartsRepositoryInterface $shoppingCartRepo
    ) {
        $this->wishlistRepo = $wishlistRepo;
        $this->shoppingCartRepo = $shoppingCartRepo;
    }

    /**
     * Set request
     *
     * @param AddWishlistRequest $request request
     *
     * @return WishlistsService
     */
    public function setRequest($request): WishlistsService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Set product id
     *
     * @param int $productId product id
     *
     * @return WishlistsService
     */
    public function setProductId(int $productId): WishlistsService
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * Get user wishlist
     *
     * @return array
     */
    public function getUserWishlist(): array
    {
        return $this->wishlistRepo
            ->setUser(Auth::user())
            ->getWishlistsByUser();
    }

    /**
     * Add wishlist
     *
     * @return void
     */
    public function addWishlist()
    {
        $shoppingCart = $this->shoppingCartRepo
            ->setShoppingCartData([
                'wish_list' => false,
                'is_expired' => false,
                'user_id' => Auth::user()->id,
                'product_id' => $this->request->product_id
            ])
            ->firstOrCreate();

        $this->shoppingCartRepo
            ->setShoppingCartId($shoppingCart->id)
            ->setShoppingCartData([
                'wish_list' => true,
                'quantity' => $this->request->quantity,
            ])
            ->updateById();
    }

    /**
     * Add wishlist
     *
     * @return void
     */
    public function removeWishlistByProductId()
    {
        $this->shoppingCartRepo
            ->setConditions([
                'wish_list' => true,
                'user_id' => Auth::user()->id,
                'product_id' => $this->productId,
            ])
            ->deleteByConditions();
    }

    /**
     * Wishlist to cart
     *
     * @return void
     */
    public function wishlistToCart()
    {
        $shoppingCart = $this->shoppingCartRepo
            ->setShoppingCartData([
                'user_id' => Auth::user()->id,
                'product_id' => $this->productId,
            ])
            ->firstOrCreate();

        $this->shoppingCartRepo
            ->setShoppingCartId($shoppingCart->id)
            ->setShoppingCartData(['wish_list' => false])
            ->updateById();
    }
}
