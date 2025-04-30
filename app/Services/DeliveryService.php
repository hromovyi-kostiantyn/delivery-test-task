<?php

namespace App\Services;

use App\Strategy\Interfaces\DeliveryStrategy;

class DeliveryService
{
    protected DeliveryStrategy $deliveryStrategy;

    public function setDeliveryStrategy(DeliveryStrategy $deliveryStrategy): void
    {
        $this->deliveryStrategy = $deliveryStrategy;

    }
    public function calculateFee(array $validated): int
    {
        $baseFee = $this->deliveryStrategy->calculateFee($validated);
        $weightFee = $this->calculateWeightFee($validated['weight']);
        $total = $baseFee + $weightFee;
        $discount = $this->calculateDiscount($validated['destination']);

        if ($discount) {
            $total = $total * ((100 - $discount) / 100);
        }

        return $total;
    }

    private function calculateWeightFee(float $weight): int
    {
        return $weight > 2 ? 10 * (int)$weight : 0;
    }

    private function calculateDiscount(string $destination): int
    {
        return match (strtolower($destination)) {
            'kyiv' => 10,
            default => 0
        };
    }
}
