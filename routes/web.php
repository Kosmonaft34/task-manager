<?php


use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/demo', function () {
    return view('welcome');
});
//Таск-менеджер Маршруты
//1. Добавление задачи POST-запрос /task/create
//1.1 Вывод страницы с формой добавления задачи GET-запрос /task/create
//2. Изменение контента текущей задачи PUT-запрос /task/update{id}
//2.1 Вывод страницы с формой изменеия контента текущей задачи GET-запрос /task/update{id}
//3. Удаление текущей задачи DELETE-запрос /task/delete{id}
//4. Список задач GET-запрос /tasks
//5. Детальный просмотр текущей задачи GET-запрос /task/{id}
// Авторизация и регистрация


//Route::post('/task/create',[TaskController::class,'store'])->name('store');
//Route::get('/task/new',[TaskController::class,'create'])->name('create');
//Route::put('/task/update/{id}',[TaskController::class,'update'])->name('update');
//Route::put('/task/update/{id}',[TaskController::class,'getUpdate'])->name('getUpdate');
//Route::delete('/task/delete/{id}',[TaskController::class,'destroy'])->name('destroy');
//Route::get('/tasks',[TaskController::class,'index'])->name('list');
//Route::get('/task/{id}',[TaskController::class,'show'])->name('show');


Route::get('/',[IndexController::class,'index'])->name('index');

//Защитим гостевые маршруты
Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'index'])->name('register'); // view регистрации
    Route::post('/register', [UserController::class, 'create'])->name('create'); // регистрация
    Route::get('/register/authorization', [UserController::class, 'authorizationIndex'])->name('authorization');//авторизация
    Route::post('/register/authorization', [UserController::class, 'autho'])->name('autho');//авторизация отправка данных
  });

//Защитим авторизованные маршруты
//1й способ по одному
Route::resource('tasks',TaskController::class)->middleware('auth');

//2й способ группа
Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'show'])->name('user.show');//auth
    Route::get('/logout', [UserController::class, 'logout'])->name('exit');
    Route::get('/delete', [TaskController::class, ''])->name('destroy');//Удаление задачи

    Route::get('/list_project', [ProjectController::class, 'index'])->name('project.index');//страница со списком проектов
    //Создание проекта
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('create.project');//страница с созданием проекта
    Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
//Редактирование проетка
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');//страница редактирования проекта по id
    Route::put('/projects/{id}/edit', [ProjectController::class, 'update'])->name('projects.update');

    //Удаление проекта
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');//детальная страница проета с айди


    //Создание задачи к проекту с айди
    Route::get('/projects/{id}/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/projects/{id}/task/create', [TaskController::class, 'store'])->name('task.store');

    //Вывод страницы с задачей
    Route::get('/projects/{id}/task/{taskID', [TaskController::class, 'show'])->name('task.show');


    //Редактирование задачи с айди=taskID проекта с айди =id
    Route::get('/projects/{id}/task/{taskID}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/projects/{id}/task/{taskID}/edit', [TaskController::class, 'update'])->name('task.update');

    //Удаление задачи
    Route::delete('/projects/{id}/task/{taskID}', [TaskController::class, 'delete'])->name('task.destroy');
});
