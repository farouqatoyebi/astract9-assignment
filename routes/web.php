<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// User Routes
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'processLogin'])->name('processLogin');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'processRegister'])->name('processRegister');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/design', function(){
    return view("random-design");
});
Route::get('/waitlist', function(){
    return view("waitlist-design");
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/users', [App\Http\Controllers\HomeController::class, 'allUsers'])->name('users');
    Route::get('/activate-user/{id}', [App\Http\Controllers\HomeController::class, 'activateUser'])->name('activate-user');
    Route::get('/suspend-user/{id}', [App\Http\Controllers\HomeController::class, 'suspendUser'])->name('suspend-user');
    Route::get('/all-messages', [App\Http\Controllers\MessagesController::class, 'allMessages'])->name('admin-messages');

    Route::get('/task-categories', [App\Http\Controllers\TaskCategoriesController::class, 'index'])->name('admin-task-categories');
    Route::get('/add-task-category', [App\Http\Controllers\TaskCategoriesController::class, 'addTaskCategoryForm'])->name('add-new-task-category');
    Route::post('/add-task-category', [App\Http\Controllers\TaskCategoriesController::class, 'addTaskCategory'])->name('submit-new-task-category');

    Route::get('/edit-task-category/{id}', [App\Http\Controllers\TaskCategoriesController::class, 'editTaskCategoryForm'])->name('edit-task-category');
    Route::post('/edit-task-category/{id}', [App\Http\Controllers\TaskCategoriesController::class, 'editTaskCategory'])->name('modify-task-category');

    Route::get('/delete-task-category/{id}', [App\Http\Controllers\TaskCategoriesController::class, 'deleteTaskCategory'])->name('delete-task-category');
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/messages', [App\Http\Controllers\MessagesController::class, 'userMessages'])->name('user-messages');
    Route::get('/send-new-message', [App\Http\Controllers\MessagesController::class, 'sendMessageForm'])->name('send-new-message');
    Route::post('/send-new-message', [App\Http\Controllers\MessagesController::class, 'submitMessageSent'])->name('submit-new-message');

    Route::get('/add-task', [App\Http\Controllers\TasksController::class, 'addNewTaskForm'])->name('add-user-task');
    Route::post('/add-task', [App\Http\Controllers\TasksController::class, 'addNewTask'])->name('submit-user-task');

});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/tasks', [App\Http\Controllers\TasksController::class, 'index'])->name('user-tasks');

    Route::get('/edit-task/{id}', [App\Http\Controllers\TasksController::class, 'editTaskForm'])->name('edit-user-task');
    Route::post('/edit-task/{id}', [App\Http\Controllers\TasksController::class, 'editTask'])->name('modify-user-task');

    Route::get('/mark-task-done/{id}', [App\Http\Controllers\TasksController::class, 'markTaskAsDone'])->name('mark-user-task-done');
    Route::get('/unmark-task-done/{id}', [App\Http\Controllers\TasksController::class, 'unMarkTaskAsDone'])->name('unmark-user-task-done');

    Route::get('/delete-task/{id}', [App\Http\Controllers\TasksController::class, 'deleteTask'])->name('delete-user-task');
});