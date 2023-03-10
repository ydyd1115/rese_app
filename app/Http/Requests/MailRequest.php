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
            'mail_title'=> 'required',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mail_title.string'=> '件名を入力してください',
            'message.string' => 'メッセージを入力してください',
        ];
    }
}
