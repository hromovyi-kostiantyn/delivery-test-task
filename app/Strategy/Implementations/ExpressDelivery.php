<?php

namespace App\Strategy\Implementations;

use App\Strategy\Interfaces\DeliveryStrategy;

class ExpressDelivery implements DeliveryStrategy
{
    private const FEE = 100;
    public function calculateFee(array $data): int
    {
        return self::FEE;
    }
}
