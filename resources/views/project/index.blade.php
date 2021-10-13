@extends ('layouts.main')

@section('title', 'Редактирование')
@section('content')
        <p>Список проектов</p>

        <div class="list-group">
           <a href="#" class="list-group-item list-group-item-action">Название проекта</a>
        </div>
        <form action="{{route('create_project')}}">
            <button type="submit" class="btn btn-primary-large w-100" background >Начать новый проект</button>
        </form>

    @endsection
