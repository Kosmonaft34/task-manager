@extends ('layouts.main')

@section('title', 'Создание нового проекта')

@section('content')
    <h3>Страница с созданием проекта</h3>
    <form method="POST" action="{{route('projects.store')}}" enctype="multipart/form-data">
        @csrf
             <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название проекта</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Введите название проекта</div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
