<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'date_time' => 'required|date|before_or_equal:today',
            'grade' => 'required',
            'comment' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'date_time.required' => 'ご来店日を入力してください',
            'date_time.date' => 'カレンダーより日付を選択してください',
            'date_time.before_or_equal' => '本日以前の日付を入力してください',
            'grade.required' => '評価を入力してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max:255' => 'コメントは125文字以内で入力してください',
        ];
    }
}
