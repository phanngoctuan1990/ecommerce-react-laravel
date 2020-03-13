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
     *
     * @param array $data data
     */
    public function store(array $data);
}
