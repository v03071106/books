<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "required|email",
            "password" => [
                "required",
                // 至少需要 8 个字符...
                Password::min(8)
                    // 至少需要一个大写字母和一个小写字母...
                    ->mixedCase()
                    // 至少需要一个字母...
                    ->letters()
                    // 至少需要一个数字...
                    ->numbers()
                    // 至少需要一个符号...
                    ->symbols()
                    // 确保密码在同一数据泄露中出现少于 0 次...
                    ->uncompromised(),
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.email' => "驗證的欄位 `:attribute` 必須符合 email 格式",
            'email.required' => '驗證的欄位 `:attribute` 為必填',
            'password.required' => '驗證的欄位 `:attribute` 為必填',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.*
    * @return array
    */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors(),
        ], 422));
    }
}
