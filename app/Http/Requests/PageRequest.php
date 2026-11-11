<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,gif,svg,webp|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter page title.',
        ];
    }
}

