<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryFeeCalculationRequest;
use App\Services\DeliveryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function __construct(
        protected DeliveryService $deliveryService
    ) {}

    public function calculateDeliveryFee(DeliveryFeeCalculationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $this->deliveryService->setDeliveryStrategy(app($validated['delivery_type']));
        $result = $this->deliveryService->calculateFee($validated);

        return response()->json($result);
    }
}
