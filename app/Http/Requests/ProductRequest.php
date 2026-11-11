<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'image_base64' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'finish_id' => 'nullable|exists:finishes,id',
            'wood_id' => 'nullable|exists:woods,id',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:png,jpeg,jpg,gif,svg,webp|max:10240',
            'gallery_images_base64' => 'nullable|array',
            'gallery_images_base64.*' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter product title.',
        ];
    }
}

