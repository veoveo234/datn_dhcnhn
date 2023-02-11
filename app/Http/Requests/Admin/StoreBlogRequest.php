<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title' => 'required|max:150|unique:blogs',
            'cate_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required|max:10000',
            'content_blog' => 'required',
        ];
    }
}
