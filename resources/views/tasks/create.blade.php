@extends ('layouts.main')

@section('title', 'Создание новой задачи')

@section('content')
 <h1>Страница с созданием заявки</h1>

 @if($errors->any())
     <div class="alert alert-danger" role="alert">
         @foreach($errors->all() as $error)
             <p>{{$error}}</p>
         @endforeach
     </div>
 @endif

 <form method="post" action="{{route('tasks.store')}}" enctype="multipart/form-data">
     @csrf

     <div class="mb-3">
         <label for="formFile" class="form-label">Изображение</label>
         <input class="form-control" type="file" id="formFile" name="file">
     </div>

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
     <div class="mb-3">
         <label class="form-label">Мини-задачи</label>
         <ul id="mini-list">

         </ul>
         <button id="add-mini" class ="btn btn-success">+ Добавить</button>
     </div>
     <button type="submit" class="btn btn-primary-large w-100">Создать задачу</button>
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
