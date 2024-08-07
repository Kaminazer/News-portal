<?php

namespace App\Http\Requests\Admin\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            return [
                'title' => ['required', 'string', 'max:255', 'unique:new,title'],
                'content' => ['required', 'string'],
                'image' => ['required', 'mimes:jpg,bmp,png,jpeg,webp,svg', 'max:2048'],
                'tags' => ['required', 'string', 'regex:/^[\w+\',]+$/u'],
                'status_display' => ['required']
            ];
    }
    public function messages()
    {
        return [
            'tags.regex' => 'Теги повинні бути введені через кому без пробілів та інших сторонніх символів окрім апострофа',
        ];
    }
}
