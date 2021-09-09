@extends ('layouts.main')

@section('title', 'Редактирование')
@section('content')
    <h1>Редактирование задачи</h1>

    <form method="POST" action="{{route('tasks.update',['task' =>$taskEdit->id])}}">
        @csrf

        @method('PUT')
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
        <button type="submit" class="btn btn-primary-large w-25">Сохранить</button>
        <button type="submit" class="btn btn-primary-large w-25">Отменить</button>
    </form>
@endsection