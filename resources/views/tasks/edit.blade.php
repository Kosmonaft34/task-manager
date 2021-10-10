@extends ('layouts.main')

@section('title', 'Редактирование')
@section('content')
    <h1>Редактирование задачи</h1>

    @if($errors->any())
    <div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    <form method="POST" action="{{route('tasks.update',['task' =>$taskEdit->id])}}" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        @isset($task->file)
            <img src="{{ asset($task->file->path) }}">
        @endisset
        <div class="mb-3">
               <label for="formFile" class="form-label">Заменить изображение</label>
            <input class="form-control" type="file" id="formFile" name="file">
        </div>

        <div class="mb-3">
            <label for="statuses" class="form-label">Статус задачи</label>
            <select class="form-select" id="statuses" name="status">
                @foreach($statusList as $status)
                <option value="{{$status->id}}"
                @if($status->id == $taskEdit->status->id) selected @endif>
                    {{$status->name}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Название задачи</label>
            <input value="{{$taskEdit->title}}" type="text" class="form-control" id="title" name="title" >
        </div>
        <div class="mb-3">
            <label  for="preview" class="form-label">Текст анонса задачи</label>
            <input value="{{$taskEdit->preview_text}}" type="text" class="form-control" id="preview"  name ="preview" placeholder="Введите текст анонса задачи">
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Полное описание задачи</label>
            <textarea class="form-control" id="detail" name="detail" rows="5">{{$taskEdit->detail_text}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Мини-задачи</label>
            <ul id="mini-list">
                @foreach($taskEdit->minis as $mini)
                    <li class="mb-3">
                        <input class="form-control" type="text" name="mini[]" value="{{$mini->text}}"/>
                    </li>
                @endforeach
                </ul>
            <button id="add-mini" class ="btn btn-success">+ Добавить</button>
        </div>
        <button type="submit" class="btn btn-primary-large w-25">Сохранить</button>
        <button type="submit" class="btn btn-primary-large w-25">Отменить</button>
    </form>
@endsection

@section('scripts')
    @parent
    <script>//JQUERY
        $("#add-mini").on("click", function (event){  //Указываем на кнопку "+Добавить" по id,функция on принимает 2 аргумента 1.это событие 'click' 2. Вложеннная функция
            event.preventDefault();
            //Логика обработки нажатия на кнопку
            $("#mini-list").append('<li class="mb-3"><input class="form-control" type="text" name="mini[]"></li>')
        });
    </script>
@endsection
