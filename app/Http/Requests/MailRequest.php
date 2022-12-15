<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'user_name' => 'string',
            'user_email' => 'string',
            'mail_title'=> 'string',
            'message' => 'string',
            'shop_name' => 'string',
            'shop_email' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'user_name.string' => 'user_nameは文字列で入力してください',
            'user_email.string' => 'user_emailは文字列で入力してください',
            'mail_title.string'=> 'mail_titleは文字列で入力してください',
            'message.string' => 'messageは文字列で入力してください',
            'shop_name.string' => 'shop_nameは文字列で入力してください',
            'shop_email.string' => 'shop_emailは文字列で入力してください',
        ];
    }
}
