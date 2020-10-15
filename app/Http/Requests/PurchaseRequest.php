<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'date' => [
                'required',
            ],
            'supplier_id' => [
                'required',
            ],
            'memo_no' => [
                'string',
                'max:50',
                'required',
            ],
            'products.*' => [
                'required',
            ],
            'price.*' => [
                'numeric',
                'min:0',
                'required',
            ],
            'qty.*' => [
                'numeric',
                'min:0',
                'required',
            ],
            'units.*' => [
                'nullable'
            ],
            'paid_amount' => [
                'numeric',
                'min:0',
                'required',
            ],
       ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Supplier Field is required',
            'products.*.required' => 'Product Name is required',
            'price.*.required' => 'Price is required',
            'price.*.numeric' => 'Price is must be a number',
            'price.*.min' => 'Price is should be greater than zero',
            'qty.*.required' => 'Quantity is required',
            'qty.*.numeric' => 'Quantity is must be a number',
            'qty.*.min' => 'Quantity is should be greater than zero',
        ];
    }
}
