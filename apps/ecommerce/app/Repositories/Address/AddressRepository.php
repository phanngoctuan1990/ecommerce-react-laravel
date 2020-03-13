<?php

namespace App\Repositories\Address;

use App\Address;

class AddressRepository implements AddressRepositoryInterface
{
    protected $address;
    protected $addressData;

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
     * Set address data
     *
     * @param array $data data
     */
    public function setAddressData(array $data): AddressRepository
    {
        $this->addressData = $data;
        return $this;
    }

    /**
     * Store address
     *
     * @return Address
     */
    public function store(): Address
    {
        return $this->address->create($this->addressData);
    }
}
