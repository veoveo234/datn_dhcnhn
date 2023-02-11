<?php

namespace App\Http\Requests\Admin\user;

use App\Rules\PhoneRegex;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileUserRequest extends FormRequest
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:150',
            'name' => 'required|max:150',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => ['required', new PhoneRegex()]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Tên giới hạn 150 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại'
        ];
    }
}
