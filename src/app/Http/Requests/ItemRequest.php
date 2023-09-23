<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'image' => ['required', 'mimes:jpeg,jpg,png,gif,tiff'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'condition_id' => ['required', 'integer', 'exists:conditions,id'],
            'brand_id' => ['required', 'integer','exists:brands,id'],
            'name' => ['required', 'string', 'max:100'],
            'detail' => ['required', 'string', 'max:10000'],
            'price' => ['required', 'integer', 'min:300','max:10000000'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '画像ファイルを選択してください',
            'category_id.required' => 'カテゴリーを選択してください',
            'brand_id.required' => 'ブランドを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'name.required' => '商品名を入力してください',
            'name.max' => '商品名を100文字以下で入力してください',
            'detail.required' => '詳細を入力してください',
            'detail.string' => '詳細を文字列で入力してください',
            'detail.max' => '詳細を10000文字以内で入力してください',
            'price.required' => '販売価格を入力してください',
            'price.integer' => '販売価格を正しく入力してください',
            'price.max' => '販売価格は300円から10,000,000円の間で設定してください',
            'price.min' => '販売価格は300円から10,000,000円の間で設定してください',
        ];
    }
}