<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zip',
        'city',
        'state',
        'phone',
        'user_id',
        'edit_disabled',
        'first_address',
        'second_address',
    ];
}
