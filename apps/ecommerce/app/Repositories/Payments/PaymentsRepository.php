<?php

namespace App\Repositories\Payments;

use App\Payment;

class PaymentsRepository implements PaymentsRepositoryInterface
{
    protected $payment;
    protected $paymentData;

    /**
     * Construct PaymentsRepository
     *
     * @param PaymentMethod $model model
     *
     * @return void
     */
    public function __construct(Payment $model)
    {
        $this->payment = $model;
    }

    /**
     * Set payment data
     *
     * @param array $data payment data
     *
     * @return PaymentsRepository
     */
    public function setPaymentData(array $data): PaymentsRepository
    {
        $this->paymentData = $data;
        return $this;
    }

    /**
     * Store payment
     *
     * @return Payment
     */
    public function store(): Payment
    {
        return $this->payment->create($this->paymentData);
    }
}
