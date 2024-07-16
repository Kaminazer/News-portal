<?php

namespace App\Http\Requests\Admin\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', Rule::unique('new','title')->ignore($this->new)],
            'content' => ['required', 'string'],
            'image' => ['mimes:jpg,bmp,png,jpeg,webp,svg', 'max:2048'],
            'tags' => ['required', 'string', 'regex:/^[\w+\',]+$/u'],
            'status_display' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'tags.regex' => 'Теги повинні бути введені через кому без пробілів та інших символім окрім апострофа',
        ];
    }
}
