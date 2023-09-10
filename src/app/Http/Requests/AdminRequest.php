<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'unique:users','max:255'],
            'password' => ['required', Password::min(8)],
            'postcode' => ['required', 'string','regex:/\d{3}-\d{4}/'],
            'address' => ['required', 'string', 'max:255'],
            'building_name' => ['nullable', 'string','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.unique' => 'そのメールアドレスはすでに登録されています',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードで8文字以上で入力してください',
            'postcode.required' => '郵便番号を入力してください',
            'postcode.regex' => '郵便番号をxxx-xxxxの形式で入力してください',
            'address.required' => '住所を入力してください',
            'building_name' => '文字数が多すぎます。255文字以下で入力してください',
        ];
    }
}