<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\File;
use App\Models\Mini;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Auth::user()->tasks()->get();
        return view('tasks.index',
        ['list'=>$tasks]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tasks=Task::select('id', 'title', 'preview_text')->get();
        return view('tasks.create',['list'=>$tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {
        //

        $data = $request->validated();
//------------------------1Й ВАРИАНТ-----------------------
//       $task = new Task();
//        $task ->title = $data['title'];
//        $task ->preview_text = $data['preview'];
//        $task ->detail_text = $data['detail'];
//        $task ->status_id = 1;
//        $task -> save();

        //------------------------2Й ВАРИАНТ-----------------------
//    $task = Task::create([
//        'title'=>$data['title'],
//        'preview_text'=>$data['preview'],
//        'detail_text'=>$data['detail']
//    ]);
        //
        $status = Status::find(1);

        $task = $status->tasks()->create([
            'title' => $data['title'],
            'preview_text' => $data['preview'],
            'detail_text' => $data['detail']
        ]);
        $task->users()->attach(Auth::id());
        //Привязать мини задачи
        if (isset($data['mini'])) {
            foreach ($data['mini'] as $mini) {
                if (strlen($mini) > 0) //Условие если длина строки больше 0,тогда выяполняется код ниже
                    $miniModel = new Mini();
                $miniModel->text = $mini;
                $miniModel->task_id = $task->id;//$task->id берём отсюда $task = $status ->tasks()->create([ 'title'=>$data['title'],
                $miniModel->save();

            }
        }

        // Привязка файла
        //Если файл был загружен пользователем
        //1.Сохраняем файл в папке images
        $path = $data['file']->store('images');
        //Сохраняем данные в базу
        //
        if (isset($date['file'])) {
            $file = new File();
            $file->task_id = $task->id;
            $file->path = $path;
            $file->name = $data['file']->getClientOriginalName();
            $file->mime = $data['file']->getClientMimeType();
            $file->save();

            return redirect(route('tasks.index'));
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $task= Task::select(
            'title',
            'detail_text',
            'status_id',
            'id')

           ->find($id);
       $status=$task->status;
        if(Auth::user()->can('view',$task)) {
            return view('tasks.show', ['task' => $task, 'status' => $status]);
        }
        else{
            return redirect(route('tasks.index'));
        }
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $statuses= Status::get();
        $edit=Task::find($id);
        if(Auth::user()->can('view',$edit)) {
            return view('tasks.edit',
                ['taskEdit' => $edit,
                    'statusList' => $statuses]
            );
        }
        else{
            return redirect(route('tasks.edit'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        //Собрали все данные с формы
        $data = $request->validated();

        // Получили необходимую задачу из базы,которую мы будем редактировать
        $task = Task::find($id);
        //Перезаписываем данные в базу
        $task->title = $data ['title'];
        $task->preview_text = $data['preview'];
        $task->detail_text = $data['detail'];
        //Сохраняем новые данные в базу
        $task->status_id = $data['status'];
        $task->save();

        if(!isset ($data['mini'])){
        //Удаляем все мини-задачи для текущей задачи
        $task->minis()->delete();
        //Сохраняем мини-задачи из формы
        foreach ($data['mini'] as $mini) {
            if (strlen($mini) > 0) //Условие если длина строки больше 0,тогда выяполняется код ниже
                $miniModel = new Mini();
            $miniModel->text = $mini;
            $miniModel->task_id = $task->id;//$task->id берём отсюда $task = $status ->tasks()->create([ 'title'=>$data['title'],
            $miniModel->save();
        }
        }

        //Если файл был загружен с формы
        if (isset($data['file'])){
            //Сохраним загруженный файл с формы
            $path = $data['file']->store('images');
            //Получим текущий файл , который был привязан к данной задаче
            $file = $task->file;
            //Если у текущей задачи НЕ был привязан старый файл
            if (!isset($date['file'])) {
                //Создаём новый файл
                $file = new File();
                //Перезаписываем данные
                $file->task_id = $task->id;

        }
                $file->task_id = $task->id;
                $file->path = $path;
                $file->name = $data['file']->getClientOriginalName();
                $file->mime = $data['file']->getClientMimeType();
                $file->save();

        }
        //Делаем редирект на страницу с детальным описанием задачи
        return redirect(route('tasks.show', ['task' => $id]));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //1.Получаем задачу по id
        $task =Task::find($id);

        //Если задача удалена ранее
        if($task->trashed()) {
            //2. Чистим мини-задачи текущей основной задачи
            $task->minis()->delete();

            //3. Удаляем файл привязанный к текущей задачи
            $task->file->delete();

            //4. Отвязываем всех пользователей от текущей задачи
            $task->users()->detach();

            //5. Удаляем саму задачу НАВСЕГДА
            $task->forcedelete();
        }else
            //Перемещаем в корзину
            $task->delete();

        return redirect(route('tasks.index'));
    }


}
