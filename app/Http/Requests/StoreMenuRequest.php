<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'category'    => 'required|in:makanan,minuman,dessert,lainnya',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ];
    }
}