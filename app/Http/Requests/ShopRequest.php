<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => 'required',
            'area' => 'required',
            'genre' => 'required',
            'comment' => 'required|string|max:255',
            'image_URL' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください',
            'area.required' => 'エリアを入力してください',
            'genre.required' => 'ジャンルを入力してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max:255' => 'コメントは125文字以内で入力してください',
            'image_URL.required' => '画像URLを入力してください',
        ];
    }
}
