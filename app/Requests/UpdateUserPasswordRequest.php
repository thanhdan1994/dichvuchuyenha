<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'oldPassword' => 'required',
            'password' => ['confirmed', 'min:6', 'max:20'],
        ];
    }

    public function messages()
    {
        return [
            'oldPassword.required' => 'Bạn phải nhập mật khẩu cũ',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng',
            'password.min' => 'Mật khẩu phải có ít nhất 6 kí tự và nhiều nhất 20 kí tự',
            'password.max' => 'Mật khẩu phải có ít nhất 6 kí tự và nhiều nhất 20 kí tự',
        ];
    }
}
