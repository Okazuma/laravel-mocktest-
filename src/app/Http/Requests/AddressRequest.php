<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'postal_code' => ['required','string','max:10'],
            'address' => ['required','string','max:100'],
            'building' => ['string','max:50'],
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.string' => '文字列で入力してください',
            'postal_code.max' => '10文字以内で入力してください',

            'address.required' => '住所を入力してください',
            'address.string' => '文字列で入力してください',
            'address.max' => '100文字以内で入力してください',

            'building.string' => '文字列で入力してください',
            'building.max' => '50文字以内で入力してください',
        ];
    }
}
