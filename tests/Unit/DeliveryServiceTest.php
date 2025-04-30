<?php

namespace Tests\Unit;

use App\Services\DeliveryService;
use App\Strategy\Implementations\ExpressDelivery;
use App\Strategy\Implementations\StandardDelivery;
use App\Strategy\Interfaces\DeliveryStrategy;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DeliveryServiceTest extends TestCase
{
    private DeliveryService $deliveryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->deliveryService = new DeliveryService();
    }

    #[Test]
    public function testSetDeliveryStrategy()
    {
        $mockStrategy = $this->createMock(DeliveryStrategy::class);

        $this->deliveryService->setDeliveryStrategy($mockStrategy);

        $this->assertTrue(true);
    }

    #[Test]
    public function testCalculateFeeWithStandardDeliveryNoExtraWeight()
    {
        $mockStrategy = $this->createMock(DeliveryStrategy::class);
        $mockStrategy->method('calculateFee')->willReturn(50);

        $this->deliveryService->setDeliveryStrategy($mockStrategy);

        $result = $this->deliveryService->calculateFee([
            'destination' => 'lviv',
            'weight' => 2,
            'delivery_type' => 'standard'
        ]);

        $this->assertEquals(50, $result); // 50
    }

    #[Test]
    public function testCalculateFeeWithExtraWeight()
    {
        $mockStrategy = $this->createMock(DeliveryStrategy::class);
        $mockStrategy->method('calculateFee')->willReturn(50);

        $this->deliveryService->setDeliveryStrategy($mockStrategy);

        $result = $this->deliveryService->calculateFee([
            'destination' => 'lviv',
            'weight' => 3,
            'delivery_type' => 'standard'
        ]);

        $this->assertEquals(80, $result); // 50 + 30
    }

    #[Test]
    public function testCalculateFeeWithExpressDelivery()
    {
        $mockStrategy = $this->createMock(DeliveryStrategy::class);
        $mockStrategy->method('calculateFee')->willReturn(100);

        $this->deliveryService->setDeliveryStrategy($mockStrategy);

        $result = $this->deliveryService->calculateFee([
            'destination' => 'lviv',
            'weight' => 5,
            'delivery_type' => 'express'
        ]);

        $this->assertEquals(150, $result); // 100 + 50
    }

    #[Test]
    public function testCalculateFeeWithKyivDiscount()
    {
        $mockStrategy = $this->createMock(DeliveryStrategy::class);
        $mockStrategy->method('calculateFee')->willReturn(100);

        $deliveryService = new DeliveryService();
        $deliveryService->setDeliveryStrategy($mockStrategy);

        $result = $deliveryService->calculateFee([
            'destination' => 'kyiv',
            'weight' => 5,
            'delivery_type' => 'express'
        ]);

        $this->assertEquals(135, $result); // (100 + 50) * 0.9
    }

    #[Test]
    public function testStandardDeliveryCalculatesFee()
    {
        $standardDelivery = new StandardDelivery();
        $this->assertEquals(50, $standardDelivery->calculateFee([]));
    }

    #[Test]
    public function testExpressDeliveryCalculatesFee()
    {
        $expressDelivery = new ExpressDelivery();
        $this->assertEquals(100, $expressDelivery->calculateFee([]));
    }
}
