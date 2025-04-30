<?php

namespace App\Providers;

use App\Enums\DeliveryStatusEnum;
use App\Strategy\Implementations\ExpressDelivery;
use App\Strategy\Implementations\StandardDelivery;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach (DeliveryStatusEnum::cases() as $case) {
            $strategyClass = match($case) {
                DeliveryStatusEnum::STANDARD => StandardDelivery::class,
                DeliveryStatusEnum::EXPRESS => ExpressDelivery::class,
            };

            $this->app->bind($case->value, $strategyClass);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
