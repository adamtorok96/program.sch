<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class IndexProgram extends FormRequest
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
            'circle'        => 'nullable|integer|exists:circles,id',
            'circles'       => 'nullable|array',
            'circles.*'     => 'integer|exists:circles,id',
            'from'          => 'nullable|date',
            'to'            => 'nullable|date'
        ];
    }
}
