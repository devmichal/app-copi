<?php

namespace App\Core\Infrastructure\Event\EventSourcing\UpdatePayment;


class UpdatePaymentTask
{
    private float $newPayment;

    private float $oldPayment;

    private float $equalPayment;


    public function __construct(
        float $newPayment,
        float $oldPayment
    )
    {

        $this->newPayment = $newPayment;
        $this->oldPayment = $oldPayment;

        $this->equalPayment = $newPayment;
    }
}