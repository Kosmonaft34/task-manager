<?php


use App\Http\Controllers\IndexController;
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

Route::resource('tasks',TaskController::class);
Route::get('/',[IndexController::class,'index'])->name('index');
Route::get('/register', [UserController::class,'index'])->name('register'); // view регистрации
Route::post('/register', [UserController::class,'create'])->name('create'); // регистрация
Route::get('register/authorization', [UserController::class, 'authorizationIndex'])->name('authorization');//авторизация
Route::post('register/authorization', [UserController::class, 'autho'])->name('autho');//авторизация отправка данных

