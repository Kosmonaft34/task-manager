<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Вычленяем id задачи из параметра маршрута {task}
        $taskID=$this->route('task');

        //Извлекаем из базы задачу с id=$taskID
        $task = Task::find($this->route('task'));

        //Если в базе нашли задачу
        if (isset($task)){
            //Возвращаем проверку политики
         return $this->user()->can('update', $task);
        }else{
            //Задачи нет, редактировать мы не можем
            return false;
        }

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
//            'название инпута'=>['набор правил']
            'title'=>['required', 'string', 'max:255'],
            'preview'=>['required', 'string', 'max:255'],
            'detail' =>['required', 'string', 'max:1000'],
            'status'=> ['required', 'numeric', 'exists:statuses,id'],
            'mini.*' => ['string', 'max:255'],
            'file' => ['file', 'image', 'max:1024'],

        ];
    }
    public function messages()
    {
      return [
          'title.required'=>'Не заполнено название задачи',
          'preview.required'=>'Не заполнен текст анонса задачи',
          'detail.required'=>'Не заполнено описание задачи',
          'title.string'=>'В поле ввода должен быть текст',
          'preview.string'=>'В поле ввода должен быть текст',
          'detail.string'=>'В поле ввода должен быть текст',
          'title.max'=>'Максимальное количество символов 255',
          'preview.max'=>'Максимальное количество символов 255',
          'detail.max'=>'Максимальное количество символов 1000',
          'status.exists'=>'Выбран неизвестный статус задачи'

      ];
    }
}
