<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Orders\OrdersRepository;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Payments\PaymentsRepository;
use App\Repositories\Contacts\ContactsRepository;
use App\Repositories\Products\ProductsRepository;
use App\Repositories\Wishlists\WishlistsRepository;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\OrderItems\OrderItemsRepository;
use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Orders\OrdersRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\Contacts\ContactsRepositoryInterface;
use App\Repositories\Payments\PaymentsRepositoryInterface;
use App\Repositories\ShoppingCarts\ShoppingCartsRepository;
use App\Repositories\Wishlists\WishlistsRepositoryInterface;
use App\Repositories\PaymentMethods\PaymentMethodsRepository;
use App\Repositories\Categories\CategoriesRepositoryInterface;
use App\Repositories\OrderItems\OrderItemsRepositoryInterface;
use App\Repositories\ShoppingCarts\ShoppingCartsRepositoryInterface;
use App\Repositories\UserPromotionCodes\UserPromotionCodesRepository;
use App\Repositories\PaymentMethods\PaymentMethodsRepositoryInterface;
use App\Repositories\UserPromotionCodes\UserPromotionCodesRepositoryInterface;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any database services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(OrdersRepositoryInterface::class, OrdersRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(ContactsRepositoryInterface::class, ContactsRepository::class);
        $this->app->bind(ProductsRepositoryInterface::class, ProductsRepository::class);
        $this->app->bind(PaymentsRepositoryInterface::class, PaymentsRepository::class);
        $this->app->bind(WishlistsRepositoryInterface::class, WishlistsRepository::class);
        $this->app->bind(CategoriesRepositoryInterface::class, CategoriesRepository::class);
        $this->app->bind(OrderItemsRepositoryInterface::class, OrderItemsRepository::class);
        $this->app->bind(ShoppingCartsRepositoryInterface::class, ShoppingCartsRepository::class);
        $this->app->bind(PaymentMethodsRepositoryInterface::class, PaymentMethodsRepository::class);
        $this->app->bind(UserPromotionCodesRepositoryInterface::class, UserPromotionCodesRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
