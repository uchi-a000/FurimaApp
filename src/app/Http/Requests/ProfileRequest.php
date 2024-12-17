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
            'nick_name'       => ['required', 'string', 'max:225'],
            'real_name'       => ['required', 'string', 'max:225'],
            'postcode'        => ['required', 'regex:/^\d{7}$/'],
            'address'         => ['required'],
            'img'             => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
            'payment_id'      => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nick_name.required'  => 'ニックネームを入力してください',
            'real_name.required'  => '名前を入力してください',
            'real_name.string'    => '名前を文字列で入力してください',
            'real_name.max'       => '名前を255文字以下で入力してください',
            'postcode.required'   => '郵便番号は必須項目です',
            'postcode.regex'      => '郵便番号は半角数字７桁で入力してください',
            'address.required'    => '住所を入力してください',
            'img.required'        => '出品画像をアップロードしてください',
            'img.image'           => '画像はjpegまたはpng形式のみアップロード可能です',
            'img.mimes'           => '画像はjpegまたはpng形式のみアップロード可能です',
            'img.max'             => '画像のサイズは2MB以内でなければなりません',
            'payment_id.required' => 'お支払い方法の種類を選択してください',

        ];
    }
}
