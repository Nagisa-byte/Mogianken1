<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'title'       => ['required'],
            'description' => ['required', 'max:255'],
            'image'       => ['required', 'image', 'mimes:jpeg,png', 'max:5120'], // 5MBまで
            'categories'  => ['required', 'array', 'min:1'],
            'condition'   => ['required'],
            'price'       => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => '商品名は必ず入力してください。',
            'description.required' => '商品の説明は必ず入力してください。',
            'description.max'      => '商品の説明は255文字以内で入力してください。',
            'image.required'       => '商品画像をアップロードしてください。',
            'image.image'          => '画像ファイルを選択してください。',
            'image.mimes'          => '画像はjpegまたはpng形式のみ使用できます。',
            'categories.required'  => 'カテゴリーを1つ以上選択してください。',
            'condition.required'   => '商品の状態を選択してください。',
            'price.required'       => '販売価格を入力してください。',
            'price.numeric'        => '販売価格は数値で入力してください。',
            'price.min'            => '販売価格は0円以上にしてください。',
        ];
    }
}
