<?php

namespace App\Http\Requests\Admin\Affiliate;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRateRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'rose_old' => 'required|integer|min:0',
            'rose_new' => 'required|integer|min:0',
        ];
    }
}
