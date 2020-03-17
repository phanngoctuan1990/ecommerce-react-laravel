<?php

namespace App\Repositories\PaymentMethods;

interface PaymentMethodsRepositoryInterface
{
    /**
     * Set payment method name
     *
     * @param string $name method name
     */
    public function setName(string $name);

    /**
     * Get payment method by method name
     */
    public function getPaymentMethodByName();
}
