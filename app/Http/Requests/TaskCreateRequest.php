<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
            //
           // 'название инпута' => ['набор правил']
            'title'=>['required', 'string', 'max:255'],
            'preview'=>['required', 'string', 'max:255'],
            'detail' =>['required', 'string', 'max:1000'],
            'mini.*' => ['string', 'max:255'],
            'file' => ['file', 'image', 'max:1024']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Не заполнено название задачи',
            'preview.required' => 'Не заполнен текст анонса задачи',
            'detail.required' => 'Не заполнено описание задачи',
            'title.string' => 'В поле ввода должен быть текст',
            'preview.string' => 'В поле ввода должен быть текст',
            'detail.string' => 'В поле ввода должен быть текст',
            'title.max' => 'Максимальное количество символов 255',
            'preview.max' => 'Максимальное количество символов 255',
            'detail.max' => 'Максимальное количество символов 1000',
            'mini.*.max' => 'Мини-задача не может быть больше 255 символов',
            'mini.*.string' => 'Мини-задача должна быть корректной строкой',
        ];
    }
}
