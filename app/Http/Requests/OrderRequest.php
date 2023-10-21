<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_intent_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
