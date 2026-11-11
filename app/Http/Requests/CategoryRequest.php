<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:191',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title.',
        ];
    }
}

