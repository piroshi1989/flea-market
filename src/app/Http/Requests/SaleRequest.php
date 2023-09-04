<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'payment_amount' => ['required', 'integer', 'min:300','max:10000000'],
            'paymentMethod_id' => ['required', 'integer', 'exists:paymentMethods,id' ],
            'shipping_name' => ['required_if:postcode,|address,', 'string' , 'max:255'],
            'postcode' => ['required_if:shipping_name,|address,', 'string','regex:/\d{3}-\d{4}/'],
            'address' => ['required_if:shipping_name,|postcode,', 'string', 'max:255'],
            'building_name' => ['string','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'shipping_name.required_if' =>  '配送先情報が不足しています。変更してください。',
            'postcode.required_if' => '配送先情報が不足しています。変更してください。',
            'address.required_if' => '配送先情報が不足しています。変更してください。',
        ];
    }
}