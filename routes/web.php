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
     Route::resource('quizcategory', 'QuizCategoryController')->except('destroy');
     Route::resource('banner', 'BannerController');

     Route::get('quiz/question/{id}','QuestionController@create')->name('quisz.question');
     Route::get('quiz/question/{id}/add','QuestionController@add')->name('quiz.questionAdd');

     Route::get('user/delete/{id}', 'UserController@destroy')->name('user.destroy');
     Route::get('quiztype/delete/{id}', 'QuizTypeController@destroy')->name('quiztype.destroy');
     Route::get('quiz/delete/{id}', 'QuizController@destroy')->name('quiz.destroy');
     Route::get('quizcategory/delete/{id}', 'QuizCategoryController@destroy')->name('quizcategory.destroy');

     Route::get('storage/user/{id}', 'UserController@picture')->name('user.picture');
     Route::get('storage/quizcategory/{id}', 'QuizCategoryController@picture')->name('quizcategory.picture');
     Route::get('storage/quiz_type/{id}', 'QuizTypeController@picture')->name('quiztype.picture');
     Route::get('storage/quiz/{id}', 'QuizController@picture')->name('quiz.picture');
     Route::get('storage/question/{id}', 'QuestionController@picture')->name('question.picture');
     Route::get('storage/answer/{id}', 'AnswerController@picture')->name('answer.picture');

   });
   Route::group(['middleware' => ['role:admin'],'prefix' => '/table'], function () {
     Route::get('/data-quiz-category', 'QuizCategoryController@getData');
     Route::get('/data-quiz-type', 'QuizTypeController@getData');
     Route::get('/data-quiz', 'QuizController@getData');
     Route::get('/data-user', 'UserController@getData');
   });
});
