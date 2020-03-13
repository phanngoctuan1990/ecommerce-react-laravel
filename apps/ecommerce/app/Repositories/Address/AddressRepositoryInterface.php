<?php

namespace App\Repositories\Address;

interface AddressRepositoryInterface
{
    /**
     * Store address
     *
     * @param array $data data
     */
    public function store(array $data);
}
