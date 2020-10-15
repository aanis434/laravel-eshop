<?php

namespace App\Http\Requests;

use App\Brand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBrandRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('brand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'max:50',
                'required',
                'unique:brands',
            ],
            'bangla_name' => [
                'string',
                'max:100',
                'nullable',
            ],
        ];
    }
}
