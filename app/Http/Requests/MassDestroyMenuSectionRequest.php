<?php

namespace App\Http\Requests;

use App\MenuSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMenuSectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('menu_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:menu_sections,id',
        ];
    }
}
