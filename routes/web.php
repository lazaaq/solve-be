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

Auth::routes(['register'=>false]);
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');

   //admin
   Route::group(['middleware' => ['role:admin'],'prefix' => '/admin'], function () {
     Route::resource('dashboard', 'DashboardController');
     Route::resource('question', 'QuestionController');
     Route::resource('user', 'UserController')->except('destroy');
     Route::resource('answersave', 'AnswerSaveController');
     Route::resource('quiztype', 'QuizTypeController')->except('destroy');
     Route::resource('lecture', 'LectureController');
     Route::resource('collager', 'CollagerController');
     Route::resource('quizcollager', 'QuizCollagerController');
     Route::resource('time', 'TimeController');
     Route::resource('quiz', 'QuizController')->except('destroy');
     Route::resource('banner', 'BannerController')->except('destroy');

     Route::get('quiz/question/{id}','QuestionController@create')->name('quisz.question');
     Route::get('quiz/question/{id}/add','QuestionController@add')->name('quiz.questionAdd');
     Route::get('quiz/bulk/{id}/import','QuizController@import')->name('quiz.import');
     Route::post('quiz/bulk/{id}/import','QuizController@saveImport')->name('quiz.saveImport');
     Route::get('quiz/import/download', 'QuizController@downloadTemplate')->name('quiz.downloadTemplate');

     Route::get('user/delete/{id}', 'UserController@destroy')->name('user.destroy');
     Route::get('quiztype/delete/{id}', 'QuizTypeController@destroy')->name('quiztype.destroy');
     Route::get('quiz/delete/{id}', 'QuizController@destroy')->name('quiz.destroy');
     Route::get('question/delete/{id}', 'QuestionController@destroy')->name('question.destroy');

     Route::get('banner/delete/{id}', 'BannerController@destroy')->name('banner.destroy');
     Route::get('banner/change-is-view/{id}', 'BannerController@changeIsView')->name('banner.changeIsView');


   });
   Route::group(['middleware' => ['role:admin'],'prefix' => '/table'], function () {
     Route::get('/data-quiz-type', 'QuizTypeController@getData');
     Route::get('/data-quiz', 'QuizController@getData');
     Route::get('/data-user', 'UserController@getData');
     Route::get('/data-banner', 'BannerController@getData');
   });
});
Route::group(['prefix' => '/storage'], function () {
  Route::get('user/{id}', 'UserController@picture')->name('user.picture');
  Route::get('quiz_type/{id}', 'QuizTypeController@picture')->name('quiztype.picture');
  Route::get('quiz/{id}', 'QuizController@picture')->name('quiz.picture');
  Route::get('question/{id}', 'QuestionController@picture')->name('question.picture');
  Route::get('answer/{id}', 'AnswerController@picture')->name('answer.picture');
  Route::get('banner/{id}', 'BannerController@picture')->name('banner.picture');
});
