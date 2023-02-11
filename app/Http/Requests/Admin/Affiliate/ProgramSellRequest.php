<?php

namespace App\Http\Requests\Admin\Affiliate;

use Illuminate\Foundation\Http\FormRequest;

class ProgramSellRequest extends FormRequest
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
            'commission_id' => 'required|integer',
            'product_id' => 'required|integer',
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'title' => 'required',
            'rose_old' => 'required|integer',
            'rose_new' => 'required|integer',
            'description' => 'required',
        ];
    }
}
