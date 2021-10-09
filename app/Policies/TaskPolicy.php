<?php

namespace App\Policies;


use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

        //
    }
    public function view(User $user,Task  $task){
        return $this->update($user,$task);
    }
    public function update (User $user,Task $task){
//$tasks-Список задач текущего пользователя массив
//$task - запрашиваемая задача
    $tasks=$user->tasks;
//    Перебираем список задач $tasks текущего пользователя
    foreach ($tasks as $usertask) {
//        Если проверяемая задача $task (а конкретно её id)
//        равен отдельной задаче из списка (тоже по id)
        if($task->id === $usertask->id) {
//            политику прошли
            return true;
        }
    }
//    Список перебрали,задачу не нашли политику НЕ прошли
    return false;
    }
}
