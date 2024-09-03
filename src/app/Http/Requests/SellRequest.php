<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'category_id' => ['required','min:1'],
            'condition' => ['required','string','max:50'],
            'name' => ['required','string','max:50'],
            'description' => ['required','string','max:200'],
            'price' => ['required','integer','min:1'],
        ];
    }

    public function messages()
    {
        return [
            'item_image.file' => '画像ファイルを選択してください',
            'item_image.mimes' => 'jpeg, png, jpg を選択してください',
            'item_image.max' => '画像サイスは5MBまでです',
            'category_id.required' => 'カテゴリーを選択してください。',
            'category_id.min' => '少なくとも1つのカテゴリーを選択してください。',
            'condition.required' => '商品の状態を入力してください',
            'condition.string' => '文字列で入力してください',
            'condition.max' => '50文字以内で入力してください',
            'name.required' => '商品名を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max' => '50文字以内で入力してください',
            'description.required' => '商品の説明を入力してください',
            'description.string' => '文字列で入力してください',
            'description.max' => '200文字以内で入力してください',
            'price.required' => '金額を入力してください',
            'price.integer' => '整数で入力してください',
            'price.min' => '1円以上に設定してください。',
        ];
    }
}
