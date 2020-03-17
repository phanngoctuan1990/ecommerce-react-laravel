<?php

namespace App\Repositories\PaymentMethods;

use App\PaymentMethod;

class PaymentMethodsRepository implements PaymentMethodsRepositoryInterface
{
    protected $name;
    protected $paymentMethod;

    /**
     * Construct PaymentMethodsRepository
     *
     * @param PaymentMethod $model model
     *
     * @return void
     */
    public function __construct(PaymentMethod $model)
    {
        $this->paymentMethod = $model;
    }

    /**
     * Set payment method name
     *
     * @param string $name payment method name
     *
     * @return PaymentMethodsRepository
     */
    public function setName(string $name): PaymentMethodsRepository
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get payment method by method name
     *
     * @return PaymentMethod|null
     */
    public function getPaymentMethodByName()
    {
        return $this->paymentMethod->whereName($this->name)->first();
    }
}
