<?php

namespace App\Http\Requests;

use App\Enums\DeliveryStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryFeeCalculationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "destination" => "required|string|max:255",
            "weight" => "required|numeric|min:1",
            "delivery_type" => ["required", "string", Rule::in(DeliveryStatusEnum::cases())]
        ];
    }
}
