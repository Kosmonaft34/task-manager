@extends('layouts.main')

@section('title', 'Задача')

@section('content')
    <h1>{{$task->title}}</h1>
    <p>{{$task->detail_text}}</p>
    <p>Статус задачи:{{$status->name}}</p>
    <a href="{{ route('tasks.edit', ['task'=>$task->id]) }}">Редактировать</a>
    <a href="{{route('tasks.index')}}" class="btn btn-primary">К списку задач</a>
@endsection

