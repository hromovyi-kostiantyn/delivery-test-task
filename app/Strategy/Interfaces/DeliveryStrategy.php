<?php

namespace App\Strategy\Interfaces;

interface DeliveryStrategy
{
    public function calculateFee(array $data): int;
}
