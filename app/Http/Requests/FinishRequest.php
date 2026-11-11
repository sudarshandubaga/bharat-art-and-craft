<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinishRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter finish name.',
        ];
    }
}
