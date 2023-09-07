<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string','regex:/\d{3}-\d{4}/'],
            'address' => ['required', 'string', 'max:255'],
            'building_name' => ['nullable', 'string','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'postcode.required' => '郵便番号を入力してください',
            'postcode.regex' => '郵便番号をxxx-xxxxの形式で入力してください',
            'address.required' => '住所を入力してください',
            'building_name' => '文字数が多すぎます。255文字以下で入力してください',
        ];
    }
}