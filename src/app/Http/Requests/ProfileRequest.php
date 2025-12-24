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
            'profile_image' => 'nullable|file|mimes:jpeg,png', // 拡張子制限
            'name' => 'required|string|max:20',
            'postal_code' => [
                'required',
                'regex:/^\d{3}-\d{4}$/', // 例: 123-4567
            ],
            'address' => 'required|string',
        ];
    }

    // エラーメッセージ
    public function messages(): array
    {
        return [
            'profile_image.mimes' => 'プロフィール画像は jpeg または png 形式のみアップロード可能です。',
            'name.required' => 'ユーザー名は必須です。',
            'name.max' => 'ユーザー名は20文字以内で入力してください。',
            'postal_code.required' => '郵便番号は必須です。',
            'postal_code.regex' => '郵便番号はハイフンありの形式（例: 123-4567）で入力してください。',
            'address.required' => '住所は必須です。',
        ];
    }
    
}
