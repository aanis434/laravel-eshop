<?php

namespace App\Http\Requests;

use App\MenuSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMenuSectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('menu_section_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
