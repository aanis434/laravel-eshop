<?php

namespace App\Http\Requests;

use App\DeliveryType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDeliveryTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('delivery_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'bangla_name' => [
                'string',
                'max:50',
                'nullable',
            ],
            'name'        => [
                'string',
                'max:50',
                'required',
                'unique:delivery_types,name,' . request()->route('delivery_type')->id,
            ],
            'status'      => [
                'required',
            ],
        ];
    }
}
