<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
            'subject' => 'required', 'string', 'max:50',
            'body'  => 'required', 'string', 'max:10000',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名を入力してください',
            'subject.max' => '文字数が制限を超えています',
            'body.required' => '本文を入力してください',
            'body.max' => '文字数が制限を超えています',
        ];
    }
}