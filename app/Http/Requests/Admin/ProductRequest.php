<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category' => 'required',
            'brand' => 'required',
            'product_name' => 'required|min:10|max:150',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'image_old' => 'required|image|mimes:jpeg,png,jpg,svg',
            'price' => 'required|min:0',
            'sale' => 'required|min:0',
            'description' => 'required',
            'status' => 'required|min:0',
            'name_size' => 'required',
            'quantity' => 'required|min:0',
            'sub_image' => 'image|mimes:jpeg,png,jpg,svg',
        ];
    }
}
