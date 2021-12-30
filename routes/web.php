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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('calendar','\App\Http\Controllers\CalendarController');



Route::get('tasks','\App\Http\Controllers\ToDoController@index');
Route::patch('tasks/{id}', '\App\Http\Controllers\ToDoController@updateTasksStatus');
Route::put('tasks/updateAll', '\App\Http\Controllers\ToDoController@updateTasksOrder');



Route::any('{all}', function () {
    return view('welcome');
})->where(['all' => '.*']);
