<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api'],'prefix' => '/collager'], function () {
  Route::post('/register', 'UserController@api_collagerRegister');
  Route::post('/login','UserController@api_collagerLogin');
});
Route::group(['middleware' => ['auth:api'],'prefix' => '/collager'], function () {
  Route::get('/logout', 'UserController@api_logout');
  Route::get('/detail', 'UserController@api_index');
  Route::put('/update', 'UserController@api_update');
  Route::put('/update-password', 'UserController@api_updatePassword');

  Route::get('/quiztype','QuizTypeController@api_index');
  Route::get('/quiz/{quiztype_id}','QuizController@api_index');
  Route::get('/question/{quiz_id}','QuestionController@api_index');
  Route::post('/quiz/store','QuizCollagerController@api_store');

  Route::get('/history','QuizCollagerController@api_history');
  Route::get('/leaderbord','QuizCollagerController@api_leaderbord');
});
