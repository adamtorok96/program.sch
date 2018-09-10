<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgram extends FormRequest
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
            'circle'            => 'required|integer|exists:circles,id',
            'name'              => 'required|string|max:40',
            'from'              => 'required|date',
            'to'                => 'required|date|after:from',
            'location'          => 'nullable|string|max:190',
            'summary'           => 'required|string|max:190',
            'description'       => 'nullable|string',
            'display_poster'    => 'nullable|boolean',
            'display_email'     => 'nullable|boolean',
            'display_site'      => 'nullable|boolean',
            'facebook_event_id' => 'nullable|integer',
            'website'           => 'nullable|string|url|max:190',
            'poster'            => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 => 'A program nevének megadása kötelező!',
            'name.string'                   => 'A program nevének karakterláncnak kell lennie!',
            'name.max'                      => 'A program neve maximálisan 40 karakter hosszú lehet!',
            'from.required'                 => 'A program kezdetének megadása kötelező!',
            'from.date'                     => 'A program kezdetének formátuma hibás!',
            'to.required'                   => 'A program végének megadása kötelező!',
            'to.date'                       => 'A program végének formátuma hibás!',
            'to.after'                      => 'A program végének a program kezdete után kell lennie!',
            'summary.required'              => 'A program rövid összefoglalásának megadása kötelező!',
            'summary.string'                => 'A program rövid összefoglalásának karakterláncnak kell lennie!',
            'summary.max'                   => 'A program rövid összefoglalásának hossza maximum 190 karakter hosszú lehet!',
            'location.nullable'             => 'location.nullable',
            'location.string'               => 'location.string',
            'description.string'            => 'description.string',
            'display_poster.boolean'        => 'display_poster.boolean',
            'display_email.boolean'         => 'display_email.boolean',
            'display_site.boolean'          => 'display_site.boolean',
            'facebook_event_id.integer'     => 'A Facebook esemény azonosítónak számnak kell lennie!',
            'website.string'                => 'website.string',
            'website.url'                   => 'A weboldal címe hibás formátumú!',
            'website.max'                   => 'A weboldal címének hossza maximum 190 karakter hosszú lehet!',
            'poster.image'                  => 'A plakátnak képnek kell lennie!'
        ];
    }
}
