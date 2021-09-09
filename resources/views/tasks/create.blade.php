@extends ('layouts.main')

@section('title', 'Создание новой задачи')

@section('content')
 <h1>Страница с созданием заявки</h1>

 <form method="post" action="{{route('tasks.store')}}">
     @csrf
 <div class="mb-3">
     <label for="title" class="form-label">Название задачи</label>
     <input type="text" class="form-control" id="title" name="title" placeholder="Введите текст">
 </div>
     <div class="mb-3">
         <label for="preview" class="form-label">Текст анонса задачи</label>
         <input type="text" class="form-control" id="preview"  name ="preview" placeholder="Введите текст анонса задачи">
     </div>
 <div class="mb-3">
     <label for="detail" class="form-label">Полное описание задачи</label>
     <textarea class="form-control" id="detail" name="detail" rows="10"></textarea>
 </div>
     <button type="submit" class="btn btn-primary-large w-100">Создать задачу</button>
 </form>
@endsection
