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
            'item_image' => ['file', 'mimes:jpeg,png,jpg', 'max:5120'],
            'name' => ['required','string','max:50'],
            'postal_code' => ['required','string','max:10'],
            'address' => ['required','string','max:100'],
            'building' => ['string','max:50'],
        ];
    }

    public function messages()
    {
        return [
            'profile_image.file' => '画像ファイルを選択してください',
            'profile_image.mimes' => 'jpeg, png, jpg を選択してください',
            'profile_image.max' => '画像サイスは5MBまでです',

            'name.required' => '名前を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '50文字以内で入力してください',

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
