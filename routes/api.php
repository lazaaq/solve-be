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
Route::middleware('api')->post('collager/register', 'UserController@api_collagerRegister');
Route::middleware('api')->post('collager/login','UserController@api_collagerLogin');
Route::middleware('auth:api')->get('collager/logout', 'UserController@api_logout');
Route::middleware('auth:api')->get('collager/detail', 'UserController@api_index');
Route::middleware('auth:api')->put('collager/update', 'UserController@api_update');
Route::middleware('auth:api')->put('collager/update-password', 'UserController@api_updatePassword');

Route::middleware('auth:api')->get('collager/quiztype','QuizTypeController@api_index');
Route::middleware('auth:api')->get('collager/quiz/{id}','QuizController@api_index');
Route::middleware('auth:api')->get('collager/question/{id}','QuestionController@api_index');
