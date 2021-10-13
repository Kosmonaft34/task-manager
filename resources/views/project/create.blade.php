@extends ('layouts.main')

@section('title', 'Создание нового проекта')

@section('content')
    <h3>Страница с созданием проекта</h3>
    <form action="{{route('tasks.create')}}">
        @csrf
        <button type="submit" class="btn btn-primary-large w-100">Создать задачу</button>
    </form>

@endsection
