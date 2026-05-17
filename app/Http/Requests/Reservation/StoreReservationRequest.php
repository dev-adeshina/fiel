<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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

            'guest_name' => [

                'required',

                'string',

                'max:255',
            ],

            'guest_email' => [

                'required',

                'email',
            ],

            'guest_phone' => [

                'required',

                'string',
            ],

            'guest_count' => [

                'required',

                'integer',

                'min:1',
            ],

            'reservation_date' => [

                'required',

                'date',

                'after_or_equal:today',
            ],

            'reservation_time' => [

                'required',
            ],

            'special_request' => [

                'nullable',

                'string',
            ],
        ];
    }
}
