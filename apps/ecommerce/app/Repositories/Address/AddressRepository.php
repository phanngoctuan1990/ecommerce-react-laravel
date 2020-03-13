<?php

namespace App\Repositories\Address;

use App\Address;

class AddressRepository implements AddressRepositoryInterface
{
    protected $address;

    /**
     * Construct AddressRepository
     *
     * @param Address $model model
     *
     * @return void
     */
    public function __construct(Address $model)
    {
        $this->address = $model;
    }

    /**
     * Store address
     *
     * @param array $data data
     *
     * @return Address
     */
    public function store(array $data): Address
    {
        return $this->address->create($data);
    }
}
