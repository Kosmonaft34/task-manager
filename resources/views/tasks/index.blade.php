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
        <a href="{{route('tasks.show',['task'=>$item->id])}}" class="card-link">Подробнее</a>
        <a href="{{route('tasks.update',['task'=>$item->id])}}" class="card-link">Редактирование</a>
            </div>
        </div>
                </div>
        @endforeach


</div>
<div class="col-12">
    <a href="{{route('tasks.create')}}" class="mt-5 d-block w-full btn btn-primary">Создать новую задачу</a>
</div>
    @endsection
