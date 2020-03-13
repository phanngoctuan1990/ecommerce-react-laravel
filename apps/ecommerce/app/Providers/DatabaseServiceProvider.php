<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Contacts\ContactsRepository;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Contacts\ContactsRepositoryInterface;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(ContactsRepositoryInterface::class, ContactsRepository::class);
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
