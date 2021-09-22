<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //
        $data = $request->all();
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
        $status=Status::find(1);

    $task = $status ->tasks()->create([
        'title'=>$data['title'],
        'preview_text'=>$data['preview'],
        'detail_text'=>$data['detail']
    ]);
    $task->users()->attach(Auth::id());
    return redirect(route('tasks.index'));
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

       $task= Task::select('title', 'detail_text','status_id','id')

           ->find($id);
       $status=$task->status;
        if(Gate::allows('update', $task)) {
            return view('tasks.show', ['task' => $task, 'status' => $status]);
            else redirect('users.authorization');
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
        return view('tasks.edit',
            ['taskEdit'=>$edit,
        'statusList'=> $statuses]
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Собрали все данные с формы
         $data=$request->all();
         // Получили необходимую задачу из базы,которую мы будем редактировать
        $task = Task::find($id);
        //Перезаписываем данные в базу
        $task->title = $data ['title'];
        $task->preview_text = $data['preview'];
        $task->detail_text = $data['detail'];
        //Сохраняем новые данные в базу
        $task->status_id = $data['status'];
        $task->save();
        //Делаем редирект на страницу с детальным описанием задачи
        return redirect(route('tasks.show',['task' =>$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
