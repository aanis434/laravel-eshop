<?php

namespace App\Http\Requests;

use App\Customer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCustomerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
            ],
            'phone'   => [
                'string',
                'required',
                'unique:customers',
            ],
            'email'   => [
                'string',
                'required',
                'unique:customers',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'status'  => [
                'required',
            ],
        ];
    }
}
