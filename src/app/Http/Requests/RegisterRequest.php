<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required','string','email','unique:users,email','max:100'],
            'password' => ['required','string','min:8','max:12','regex:/^[a-zA-Z0-9]*$/'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => 'メールアドレス形式で入力してください',
            'email.unique' => 'このメールアドレスは既に使われています',
            'email.max' => '100文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.string' => 'パスワードは文字列で入力してください',
            'password.min' => 'パスワードは8桁以上で入力してください',
            'password.max' => 'パスワードは12桁以内で入力してください',
            'password.regex' => 'パスワードは半角英数字のみで入力してください',
        ];
    }
}
