<?php

namespace App\Http\Requests;

use App\Customer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'unique:customers,phone,' . request()->route('customer')->id,
            ],
            'email'   => [
                'string',
                'required',
                'unique:customers,email,' . request()->route('customer')->id,
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
