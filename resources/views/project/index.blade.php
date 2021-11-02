@extends ('layouts.main')

@section('title', 'Редактирование')
@section('content')
        <p>Список проектов</p>
        <div class="mb-3">
            <label for="formFile" class="form-label">Заменить изображение</label>
            <input class="form-control" type="file" id="formFile" name="file">
        </div>

        <div class="list-group">
           <a href="#" class="list-group-item list-group-item-action">Название проекта</a>
        </div>
         <a href="{{route('create.project')}}">Начать новый проект</a>


    @endsection
