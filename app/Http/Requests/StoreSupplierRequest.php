<?php

namespace App\Http\Requests;

use App\Supplier;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupplierRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('supplier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'unique:suppliers',
            ],
            'email'   => [
                'string',
                'required',
                'unique:suppliers',
            ],
            'address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
