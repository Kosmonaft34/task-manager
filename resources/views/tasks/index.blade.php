@extends('layouts.main')
@section('content')
<div class="row">

        @foreach($list as $item)
            <div class="col-3">
        <div class ="card">
            <div class="card-body" >
        <h5 class="card-title" class="">{{$item->title}}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{$item->status->name}}</h6>
        <p class="card-text">{{$item->preview_text}}</p>
                <div class = "row">
                    <div class="col-6">
                        <a href="{{route('tasks.show',['task'=>$item->id])}}" class="card-link">Подробнее</a>
                    </div>
                    <div class="col-6">
                        <a href="{{route('tasks.update',['task'=>$item->id])}}" class="card-link">Редактирование</a>
                        <form method="post" action="{{route('tasks.destroy', ['task' => $item->id])}}">
                        @csrf
                         @method('DELETE')
                         <button type="submit" class = "btn btn-danger">Удалить</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endforeach


</div>
<div class="col-12">
    <a href="{{route('tasks.create')}}" class="mt-5 d-block w-full btn btn-primary">Создать новую задачу</a>
</div>
@csrf
@method('PUT')
<div class="col-12">
    <a href="{{route('destroy')}}" class="mt-5 d-block w-full btn btn-danger">Удалённые задачи</a>
</div>
    @endsection
