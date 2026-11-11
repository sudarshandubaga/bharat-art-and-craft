<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $admin = $this->route('admin');
        $adminId = is_object($admin) ? $admin->id : $admin;

        return [
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore($adminId),
            ],
            'phone' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter first name.',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'E-mail already exists.',
        ];
    }
}

