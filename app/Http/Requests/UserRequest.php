<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'nickname' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'name.max:20' => '10文字以内で入力してください',
            'nickname.required' => 'ニックネームを入力してください',
            'nickname.max:20' => '10文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.unique' => 'そのメールアドレスは使用済みです',
            'password.required' => 'パスワードを入力してください',
            'password.max:100,' => '100文字以内で入力してください',
        ];
    }
}
