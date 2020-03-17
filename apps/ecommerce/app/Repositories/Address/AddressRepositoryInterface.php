<?php

namespace App\Repositories\Address;

interface AddressRepositoryInterface
{
    /**
     * Set address data
     *
     * @param array $data data
     */
    public function setAddressData(array $data);

    /**
     * Store address
     */
    public function store();
}
