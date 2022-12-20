<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRequest extends FormRequest
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
            'm_family_name' =>'required',
            'm_first_name' =>'required',
            'm_email' => 'required|email|unique:administers,email',
        ];
    }

    public function messages()
    {
        return [
            'm_family_name.required' =>'姓を入力してください',
            'm_first_name.required' =>'姓を入力してください',
            'm_email.required' => 'メールアドレスを入力してください',
            'm_email.email' => 'メールアドレスの形式で入力してください',
        ];
    }
}
