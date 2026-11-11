<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'remark' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter testimonial name.',
        ];
    }
}

