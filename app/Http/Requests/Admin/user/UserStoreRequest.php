<?php

namespace App\Http\Requests\Admin\user;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirm' => 'required|required_with:password|same:password|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'password_confirm.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'password_confirm.same' => 'Xác nhận mật khẩu không trùng khớp',
        ];
    }
}
