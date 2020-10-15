<?php

namespace App\Http\Requests;

use App\Menu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMenuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('menu_edit');
    }

    public function rules()
    {
        return [
            'name'         => [
                'string',
                'required',
            ],
            'route_name'   => [
                'string',
                'nullable',
            ],
            'url'          => [
                'string',
                'nullable',
            ],
            'icon_or_logo' => [
                'string',
                'nullable',
            ],
        ];
    }
}
