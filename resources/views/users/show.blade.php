@extends('layouts.main')
@section('title','Личный кабинет')
@section('content')
    <div>
        <h1>{{$user->surname}} {{$user->name}}</h1>
        <p>Дата рожденрия::{{$user->Date_birth}}</p>
        <p>Почта:{{$user->email}}</p>
    </div>

    @endsection
