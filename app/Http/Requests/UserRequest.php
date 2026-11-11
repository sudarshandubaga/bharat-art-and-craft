<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = $this->route('user');
        $userId = is_object($user) ? $user->id : $user;

        return [
            'title' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
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

