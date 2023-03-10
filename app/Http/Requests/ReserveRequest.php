<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'date' => 'required|date|after_or_equal:tomorrow',
            'time' => 'required',
            'number' => 'required|integer|between:1,30',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => 'カレンダーより選択してください',
            'date.after_or_equal' => '明日以降の日付を入力してください',
            'time.required' => '時間を入力してください',
            'number.required' => '人数を入力してください',
            'number.between' => '人数は1~30人で入力してください',
        ];
    }
}
