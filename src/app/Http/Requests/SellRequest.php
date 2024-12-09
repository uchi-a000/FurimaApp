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
            'condition_id'  => ['required'],
            'item_name'     => ['required', 'string', 'max:225'],
            'price'         => ['required', 'regex:/^\d+$/'],
            'description'   => ['max:1000'],
            'item_img'      => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
            'category_item_ids' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'condition_id.required'      => '商品の状態を選択してください',
            'item_name.required'         => '商品名を入力してください',
            'item_name.string'           => '商品名を文字列で入力してください',
            'item_name.max'              => '商品名を255文字以下で入力してください',
            'description.max'            => '説明は1000文字以内で入力してください',
            'price.required'             => '金額を入力してください',
            'price.regex'                => '金額半角数字のみ入力してください（例:1000）',
            'item_img.required'          => '出品画像をアップロードしてください',
            'item_img.image'             => '画像はjpegまたはpng形式のみアップロード可能です',
            'item_img.mimes'             => '画像はjpegまたはpng形式のみアップロード可能です',
            'item_img.max'               => '画像のサイズは2MB以内でなければなりません',
            'category_item_ids.required' => 'カテゴリーを選択してください'
        ];
    }
}
