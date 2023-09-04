<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id' ],
            'item_id' => ['required', 'integer', 'exists:items,id' ],
            'detail' => ['required', 'string', 'max:10000'],
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => '詳細を入力してください',
            'detail.string' => '詳細を文字列で入力してください',
            'detail.max' => '詳細を10000文字以内で入力してください',
        ];
    }
}