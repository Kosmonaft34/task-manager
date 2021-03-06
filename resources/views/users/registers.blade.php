@extends ('layouts.main')

@section('title', 'Регистрация')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
        .form-group{
            margin-bottom: 15px;
        }
        label{
            margin-bottom: 15px;
        }
        input,
        input::-webkit-input-placeholder {
            font-size: 11px;
            padding-top: 3px;
        }
        .form-control {
            height: auto!important;
            padding: 8px 12px !important;
        }
        .input-group {
            box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.21)!important;
        }
        #button {
            border: 1px solid #ccc;
            margin-top: 28px;
            padding: 6px 12px;
            color: #666;
            text-shadow: 0 1px #fff;
            cursor: pointer;
            border-radius: 3px 3px;
            box-shadow: 0 1px #fff inset, 0 1px #ddd;
            background: #f5f5f5;
            background: -moz-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f5f5f5), color-stop(100%, #eeeeee));
            background: -webkit-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: -o-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: -ms-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            background: linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5f5f5', endColorstr='#eeeeee', GradientType=0);
        }
        .main-form{
            margin-top: 30px;
            margin: 0 auto;
            max-width: 400px;
            padding: 10px 40px;
            background:#009edf;
            color: #FFF;
            text-shadow: none;
            box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
        }
        span.input-group-addon i {
            color: #009edf;
            font-size: 17px;
        }
        .login-button{
            margin-top: 5px;
        }
    </style>

    <div class="container">
        <div class="row main-form">
            <form class="" method="post" action="{{route('create')}}">
                @csrf
                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Фамилия</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="surname" id="email" placeholder="Введите Вашу Фамилию" value="{{ old('surname') }}"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Имя</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="name" id="email" placeholder="Введите Ваше имя" value="{{ old('name') }}"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Отчество</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="patronymic" id="email" placeholder="Введите Ваше Отчество" value="{{ old('patronymic') }}"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Дата рождения</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="date" class="form-control" name="Date_Birth" id="email" placeholder="Введите Вашу дату рождения" value="{{ old('Date_Birth') }}"/>
                        </div>
                    </div>
                </div>

                               <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">e-mail</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="email" id="confirm" placeholder="Введите Ваш e-mail" value="{{ old('email') }}"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"/>
                        </div>
                    </div>
                </div>



                <div class="form-group ">
                    <button type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button">Зарегистрироваться</button>
                </div>

            </form>
        </div>
    </div>
@endsection
