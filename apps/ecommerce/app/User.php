<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const TYPE_BUYER = 2;
    const TYPE_SELLER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get shopping cart items by user.
     */
    public function shoppingCartItems()
    {
        return $this->hasMany(ShoppingCart::class)
            ->where('wish_list', false)
            ->where('is_expired', false);
    }

    /**
     * Get wish list items by user.
     */
    public function wishlistItems()
    {
        return $this->hasMany(ShoppingCart::class)
            ->where('wish_list', true)
            ->where('is_expired', false)
            ->with(['product', 'product.image']);
    }

    /**
     * Get address by user.
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
