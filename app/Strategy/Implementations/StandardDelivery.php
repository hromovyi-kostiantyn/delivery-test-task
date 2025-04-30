<?php

namespace App\Strategy\Implementations;

use App\Strategy\Interfaces\DeliveryStrategy;

class StandardDelivery implements DeliveryStrategy
{

    protected const FEE = 50;

    public function calculateFee(array $data): int
    {
        return self::FEE;
    }
}
