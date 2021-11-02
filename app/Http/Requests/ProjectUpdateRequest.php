<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Вычленяем id проекта из параметра маршрута {project}
        $projectID=$this->route('id');//id из маршрута  Route::put('projects/{id}/edit', [ProjectController::class, 'update'])->name('projects.update');

        //Извлекаем из базы проект с id=$projectID
        $project = Project::find($projectID);

        //Если в базе нашли проект
        if (isset($project)){
            //Возвращаем проверку политики
            return $this->user()->can('update', $project);
        }else{
            //Задачи нет, редактировать мы не можем
            return false;
        }
        return false;
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
        ];
    }
}
