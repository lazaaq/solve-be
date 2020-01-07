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
// Route::group(['middleware' => ['api']], function () {
//   Route::put('quiztype/{id}', 'QuizTypeController@update')->name('quiztype.update');
// });
Route::group(['middleware' => ['api'],'prefix' => '/collager'], function () {
  Route::post('/register', 'UserController@api_collagerRegister');
  Route::post('/login','UserController@api_collagerLogin');
  Route::post('/forgot-password', 'Auth\ForgotPasswordAPIController');
  Route::get('/version', 'VersionAppController@api_index');
});
Route::group(['middleware' => ['auth:api'],'prefix' => '/collager'], function () {
  Route::get('/logout', 'UserController@api_logout');
  Route::get('/detail', 'UserController@api_index');
  Route::put('/update', 'UserController@api_update');
  Route::put('/update-password', 'UserController@api_updatePassword');
  Route::put('/upload-avatar', 'UserController@api_uploadAvatar');

  Route::get('/category','QuizCategoryController@api_index');
  Route::get('/quiztype/{category_id}','QuizTypeController@api_index');
  Route::get('/quiz/{quiztype_id}','QuizController@api_index');
  Route::get('/question/{quiz_id}','QuestionController@api_index');
  Route::post('/question/{quiz_id}','QuestionController@api_store');
  Route::get('/question/code/{code}','QuizController@api_indexByCode');
  Route::post('/quiz/store','QuizCollagerController@api_store');

  Route::get('/history','QuizCollagerController@api_history');
  Route::get('/leaderboard','QuizCollagerController@api_leaderboard');
  Route::get('/leaderboard-podium/{id_quiz}','QuizCollagerController@api_leaderboardQuizPodium');
  Route::get('/leaderboard-not-podium/{id_quiz}','QuizCollagerController@api_leaderboardQuizNotPodium');

  Route::get('/banner','BannerController@api_index');

  Route::get('/history','HistoryController@api_index');
  Route::get('/history/{quiz_collager_id}','HistoryController@api_detailHistory');
});

Route::group(['middleware' => ['api'],'prefix' => '/storage'], function () {
  Route::get('user/{pictureName}', 'ImageController@pictureUser');
  Route::get('quiz_type/{pictureName}', 'ImageController@pictureType');
  Route::get('quiz_category/{pictureName}', 'ImageController@pictureCategory');
  Route::get('quiz/{pictureName}', 'ImageController@pictureQuiz');
  Route::get('question/{pictureName}', 'ImageController@pictureQuestion');
  Route::get('answer/{pictureName}', 'ImageController@pictureAnswer');
  Route::get('banner/{pictureName}', 'ImageController@pictureBanner');
});
