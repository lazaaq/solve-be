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

Auth::routes(['register'=>false,'reset'=>false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');

   //admin
   Route::group(['middleware' => ['role:admin'],'prefix' => '/admin'], function () {
     Route::resource('dashboard', 'DashboardController');
     // Route::resource('question', 'QuestionController');
     Route::resource('user', 'UserController')->except('destroy');
     Route::resource('answersave', 'AnswerSaveController');
     Route::resource('quiztype', 'QuizTypeController');
     Route::resource('lecture', 'LectureController');
     Route::resource('collager', 'CollagerController');
     Route::resource('quizcollager', 'QuizCollagerController');
     Route::resource('time', 'TimeController');
     Route::resource('quiz', 'QuizController');

<<<<<<< HEAD
     Route::get('quiz/question/{id}','QuestionController@create');
=======
     Route::get('user/delete/{id}', 'UserController@destroy')->name('user.destroy');
>>>>>>> 287f89abfbe07609ac500b4109d4f9a838ef18fc
   });
   Route::group(['middleware' => ['role:admin'],'prefix' => '/table'], function () {
     Route::get('/data-quiz-type', 'QuizTypeController@getData');
     Route::get('/data-quiz', 'QuizController@getData');
     Route::get('/data-user', 'UserController@getData');
   });
});
