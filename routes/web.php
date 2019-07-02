<?php

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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('question', 'QuestionController');
Route::resource('user', 'UserController');
Route::resource('answersave', 'AnswerSaveController');
Route::resource('quiztype', 'QuizTypeController');
Route::resource('lecture', 'LectureController');
Route::resource('collager', 'CollagerController');
Route::resource('quizcollager', 'QuizCollagerController');
Route::resource('time', 'TimeController');
Route::resource('quiz', 'QuizController');
