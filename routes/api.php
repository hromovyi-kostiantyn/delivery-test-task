<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

Route::post('/calculate-delivery-fee', [DeliveryController::class, 'calculateDeliveryFee'])->name('calculate-delivery-fee');
