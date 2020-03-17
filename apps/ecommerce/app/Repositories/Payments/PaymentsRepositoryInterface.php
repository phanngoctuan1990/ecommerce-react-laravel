<?php

namespace App\Repositories\Payments;

interface PaymentsRepositoryInterface
{
    /**
     * Set payment data
     *
     * @param array $data payment data
     */
    public function setPaymentData(array $data);

    /**
     * Store payment
     */
    public function store();
}
