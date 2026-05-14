<?php

namespace App\Http\Requests\Menu;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class UpdateMenuItemVariantRequest extends FormRequest
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
        $variantId = $this->route('variant')->id;
        return [

            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],

            'sku' => [
                'sometimes',
                'string',

                Rule::unique(
                    'menu_item_variants',
                    'sku'
                )->ignore($variantId),
            ],

            'price' => [
                'sometimes',
                'numeric',
                'min:0',
            ],

            'price_adjustment' => [
                'nullable',
                'numeric',
            ],

            'is_default' => [
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }
}
