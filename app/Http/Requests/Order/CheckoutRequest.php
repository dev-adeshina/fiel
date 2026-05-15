<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'type' => [

                'required',

                'in:delivery,pickup,dine-in',
            ],

            'customer_name' => [

                'required',

                'string',

                'max:255',
            ],

            'customer_email' => [

                'nullable',

                'email',
            ],

            'customer_phone' => [

                'nullable',

                'string',

                'max:30',
            ],

            'delivery_address' => [

                'nullable',

                'string',
            ],

            'notes' => [

                'nullable',

                'string',
            ],
        ];
    }
}
