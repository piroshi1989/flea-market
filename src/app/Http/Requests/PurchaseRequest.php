<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'user_id' => ['required','integer'],
            'item_id' => ['required','integer'],
            'payment_amount' => ['required','integer'],
            'payment_method_id' => ['required','integer'],
            'shipping_name' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string','regex:/\d{3}-\d{4}/'],
            'address' => ['required', 'string', 'max:255'],
            'building_name' => ['nullable', 'string','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'postcode.required' => '郵便番号が不足しています',
            'address.required' => '住所が不足しています',
            'building_name' => '文字数が多すぎます。255文字以下で入力してください',
        ];
    }
}