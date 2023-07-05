<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
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
            "title" => "required|string",
            "author" => "required|string",
            "published_at" => "nullable|date",
            "category" => "required|string",
            "price" => "numeric",
            "quantity" => "numeric",
            "images.name"  => 'required|string',
            "images.path"  => 'required|string',
            // "images.*.*"  => 'required|string',
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
            'title.string' => '驗證的欄位 `:attribute` 必須符合字串格式',
            'title.required' => '驗證的欄位 `:attribute` 為必填',
            'author.string' => '驗證的欄位 `:attribute` 必須符合字串格式',
            'author.required' => '驗證的欄位 `:attribute` 為必填',
            'published_at.datetime' => '驗證的欄位 `:attribute` 必須符合字串格式',
            'category.string' => '驗證的欄位 `:attribute` 必須符合字串格式',
            'category.required' => '驗證的欄位 `:attribute` 為必填',
            'price.number' => '驗證的欄位 `:attribute` 必須符合數字格式',
            'quantity.number' => '驗證的欄位 `:attribute` 必須符合數字格式',
            'images.name.string' => '驗證的欄位 `:attribute` 必須符合字串格式',
            'images.path.string' => '驗證的欄位 `:attribute` 必須符合字串格式',

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
