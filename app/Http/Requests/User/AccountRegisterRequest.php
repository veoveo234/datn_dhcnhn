<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AccountRegisterRequest extends FormRequest
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
            //
            'email' => 'required|email|unique:members',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required',
            'address' => 'required',
            // 'phone' => 'required|regex:/^0[1-9]{9}$/|unique:members',
            'phone' => 'required|min:8',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
