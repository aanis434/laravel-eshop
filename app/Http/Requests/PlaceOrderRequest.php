<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class PlaceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:50',
                'required',
            ],
            'phone' => [
                'string',
                'min:11',
                'required',
            ],
            'alternative_phone' => [
                'string',
                'min:11',
                'nullable',
            ],
            'address' => [
                'string',
                'required',
            ],
            'create_account' => [
                'sometimes',
                'bool',
            ],
            'email' => [
                'exclude_unless:create_account,true',
                'email',
                'required',
                'unique:users',
            ],
            'password' => [
                'exclude_unless:create_account,true',
                'required',
            ],
            'different_shipping_address' => [
                'bool',
            ],
            'shipping_name' => [
                'exclude_unless:different_shipping_address,true',
                'string',
                'max:100',
                'required',
            ],
            'shipping_phone' => [
                'exclude_unless:different_shipping_address,true',
                'string',
                'min:11',
                'required',
            ],
            'shipping_alternative_phone' => [
                'exclude_unless:different_shipping_address,true',
                'string',
                'min:11',
                'nullable',
            ],
            'shipping_address' => [
                'exclude_unless:different_shipping_address,true',
                'string',
                'required',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'payment_type' => [
                'required',
            ],
       ];
    }
}
