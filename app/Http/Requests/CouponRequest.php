<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required'],
            'expires_at' => ['required', 'date'],
            'value' => ['required', 'numeric'],
            'discount_type' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
