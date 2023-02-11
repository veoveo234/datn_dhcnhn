<?php

namespace App\Http\Requests\User\Affiliate;

use Illuminate\Foundation\Http\FormRequest;

class PartnerLoginRequest extends FormRequest
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
            'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.regex' => 'Email không đúng định dạng',
            'password.required'  => 'Mật khẩu không được để trống',
            'password.regex'  => 'Mật khẩu phải từ 8 ký tự trở lên và bao gồm chữ cái viết hoa, chữ cái viết thường, số và ký tự đặc biệt',
        ];
    }
}
