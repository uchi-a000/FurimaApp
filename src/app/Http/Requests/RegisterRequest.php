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
            'nick_name'     => ['required', 'string', 'max:225'],
            'email'    => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'min:8', 'max:191'],
        ];
    }

    public function messages()
    {
        return [
            'nick_name.required'     => 'ニックネームを入力してください',
            'nick_name.string'       => 'ニックネームを文字列で入力してください',
            'nick_name.max'          => 'ニックネームを255文字以下で入力してください',
            'email.required'    => 'メールアドレスを入力してください',
            'email.string'      => 'メールアドレスを文字列で入力してください',
            'email.email'       => '有効なメールアドレス形式を入力してください',
            'email.unique'      => 'すでに使用されているメールアドレスです',
            'email.max'         => 'メールアドレスを255文字以下で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.max'      => 'パスワードを191文字以下で入力してください',
            'password.min'      => 'パスワードを8文字以上で入力してください',
        ];
    }
}
