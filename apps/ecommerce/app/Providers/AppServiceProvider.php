<?php

namespace App\Providers;

use App\Contracts\Mail\VerifyMail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Mail\VerifyMailAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VerifyMailAdapter::class, VerifyMail::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
