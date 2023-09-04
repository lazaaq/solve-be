<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizCategoryController;
use App\Http\Controllers\QuizCollagerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizTemporaryController;
use App\Http\Controllers\QuizTypeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersionAppController;
use App\QuizCollager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
  Route::post('/register', [UserController::class, 'api_collagerRegister']);
Route::post('/login', [UserController::class, 'api_collagerLogin']);
  Route::post('/forgot-password', 'Auth\ForgotPasswordAPIController');
  Route::get('/version', [VersionAppController::class, 'api_index']);
  Route::get('/school', [SchoolController::class, 'api_index']);
});

Route::group(['middleware' => ['auth:api'],'prefix' => '/collager'], function () {
  Route::get('/logout', [UserController::class, 'api_logout']);
  Route::get('/detail', [UserController::class, 'api_index']);
  Route::put('/update', [UserController::class, 'api_update']);
  Route::put('/update-password', [UserController::class, 'api_updatePassword']);
  Route::put('/upload-avatar', [UserController::class, 'api_uploadAvatar']);

  Route::get('/category', [QuizCategoryController::class, 'api_index']);
  Route::get('/quiztype/{category_id}', [QuizTypeController::class, 'api_index']);
  Route::get('/quiz/{quiztype_id}', [QuizController::class, 'api_index']);
  Route::get('/question/{quiz_id}', [QuestionController::class, 'api_index']);
  Route::post('/question/{quiz_id}', [QuestionController::class, 'api_store']);
  Route::get('/question/code/{code}', [QuizController::class, 'api_indexByCode']);
  
  Route::get('/find-quizcategory/{id_quizcategory}', [QuizCategoryController::class, 'api_show']);
  Route::get('/find-quiztype/{id_quiztype}', [QuizTypeController::class, 'api_show']);
  Route::get('/find-quiz/{id_quiz}', [QuizController::class, 'api_show']);

  Route::get('/quiz/answers/{id_quiz}', [QuizController::class, 'api_quiz_answers']);
  Route::post('/quiz/store', [QuizCollagerController::class, 'api_store']);

  Route::get('/leaderboard', [QuizCollagerController::class, 'api_leaderboard']);
  Route::get('/leaderboard-podium/{id_quiz}', [QuizCollagerController::class, 'api_leaderboardQuizPodium']);
  Route::get('/leaderboard-not-podium/{id_quiz}', [QuizCollagerController::class, 'api_leaderboardQuizNotPodium']);

  Route::get('/banner', [BannerController::class, 'api_index']);

  Route::get('/history', [HistoryController::class, 'api_index']);
  Route::get('/history/{quiz_collager_id}', [HistoryController::class, 'api_detailHistory']);
  Route::get('/history/{quiz_collager_id}/result', [HistoryController::class, 'api_result']);


  Route::post('/quiz-temporary', [QuizTemporaryController::class, 'store']);
  Route::post('/quiz-temporary/{id_quiz_temporary}', [QuizTemporaryController::class, 'storeAnswer']);

  // material
    Route::get('/material/{quiz_type_id}/{idMaterial}/module/{idModule}/detail', [MaterialController::class, 'api_module_detail']);
    Route::get('/material/{quiz_type_id}/{id}/module', [MaterialController::class, 'api_show']);
    Route::get('/material/{quiztype_id}', [MaterialController::class, 'api_index']);

 
});

Route::group(['middleware' => ['api'],'prefix' => '/storage'], function () {
  Route::get('user/{pictureName}', [ImageController::class, 'pictureUser']);

  Route::get('quiz_type/{pictureName}', [ImageController::class, 'pictureType']);
  Route::get('quiz_category/{pictureName}', [ImageController::class, 'pictureCategory']);
  Route::get('quiz/{pictureName}', [ImageController::class, 'pictureQuiz']);
  Route::get('question/{pictureName}', [ImageController::class, 'pictureQuestion']);

  Route::get('answer/{pictureName}', [ImageController::class, 'pictureAnswer']);
  Route::get('banner/{pictureName}', [ImageController::class, 'pictureBanner']);
});


