<?php

namespace App\Http\Requests\User\Affiliate;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRegisterRequest extends FormRequest
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
            'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
            'profession' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'password_confirm' => 'required|required_with:password|same:password',
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
            'profession.required' => 'Nghề nghiệp không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required'  => 'Số điện thoại không được để trống',
            'phone.regex'  => 'Số điện thoại không đúng',
            'password.required'  => 'Mật khẩu không được để trống',
            'password.regex'  => 'Mật khẩu phải từ 8 ký tự trở lên và bao gồm chữ cái viết hoa, chữ cái viết thường, số và ký tự đặc biệt',
            'password_confirm.required'  => 'Xác thực mật khẩu không được để trống',
            'password_confirm.required_with'  => 'Xác thực mật khẩu không khớp',
            'password_confirm.same'  => 'Xác thực mật khẩu không khớp',
        ];
    }
}
