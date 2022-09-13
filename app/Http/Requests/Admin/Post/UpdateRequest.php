<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'Title'=>'required|string',
            'Content'=>'required|string',
            'main_image'=>'required|file',
            'preview_image'=>'required|file',
            'category_id'=>'required|integer|exists:categories,id',
            'tag_ids' => 'array|nullable',
            'tag_ids.*' => 'integer|exists:tags,id|nullable',
        ];
    }

    public function messages()
    {
        return [
            'Title.required' => 'Это поле необходимо для заполнения',
            'Title.string' => 'Данные должны соответствовать строчному типу',
            'Content.required' => 'Это поле необходимо для заполнения',
            'Content.string' => 'Данные должны соответствовать строчному типу',
            'preview_image.required' => 'Это поле необходимо для заполнения',
            'preview_image.file'=>'Необходимо выбрать файл',
            'main_image.required' => 'Это поле необходимо для заполнения',
            'main_image.file'=>'Необходимо выбрать файл',
            'category_id.required'=>'Это поле необходимо для заполнения',
            'category_id.integer'=>'Id категории должен быть числом',
            'category_id.exists'=>'Id категории должен быть в базе данных',
            'tag_ids.array'=>'Необходимо отправить массив данных'
        ];
    }
}
