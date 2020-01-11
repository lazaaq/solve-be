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
Route::get('/clear-cache', function() {
  $exitCode = Artisan::call('config:clear');
  $exitCode = Artisan::call('cache:clear');
  $exitCode = Artisan::call('config:cache');
  return 'DONE'; //Return anything
});

Auth::routes();
// Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
Route:: get ('/coba', function () {
   return view('layout.layoutclean');
})->middleware('isAdmin')->middleware('verified');;
//admin
Route::group(['middleware' => 'auth'], function () {
    Route:: get ('/success-reset', function () {
        return view('auth.passwords.success');
    });
    Route::group(['middleware' => ['role:admin|teacher'],'prefix' => '/admin'], function () {
        Route::group(['middleware' => ['role:admin']], function () {
            Route::resource('user', 'UserController')->except('destroy');
            Route::resource('answersave', 'AnswerSaveController');
            Route::resource('lecture', 'LectureController');
            Route::resource('collager', 'CollagerController');
            Route::resource('quizcollager', 'QuizCollagerController');
            Route::resource('version', 'VersionAppController')->except('destroy');
            Route::resource('banner', 'BannerController')->except('destroy');
            Route::resource('school', 'SchoolController')->except('destroy');

            Route::get('user/delete/{id}', 'UserController@destroy')->name('user.destroy');
            Route::put('user/profile/{id}', 'UserController@updateProfil')->name('user.updateProfil');
            Route::put('user/profile/password/{id}', 'UserController@updatePassword')->name('user.updatePassword');

            Route::get('banner/delete/{id}', 'BannerController@destroy')->name('banner.destroy');
            Route::post('banner/change-is-view/{id}', 'BannerController@changeIsView')->name('banner.changeIsView');

            Route::get('version/delete/{id}', 'VersionAppController@destroy')->name('version.destroy');
            Route::get('school/delete/{id}', 'SchoolController@destroy')->name('school.destroy');

        });
        Route::resource('dashboard', 'DashboardController');
        Route::resource('history', 'HistoryController');
        Route::get('history/detail/{id}', 'HistoryController@detailHistory')->name('detailHistory');
        Route::resource('quiztype', 'QuizTypeController')->except('destroy');
        Route::resource('quizcategory', 'QuizCategoryController')->except('destroy');
        Route::resource('quiz', 'QuizController')->except('destroy');
        Route::resource('question', 'QuestionController');
        Route::resource('classroom', 'ClassroomController')->except('destroy');
        Route::resource('collager-classroom', 'CollagerClassroomController')->except('destroy');


        Route::get('quiz/question/{id}','QuestionController@create')->name('quisz.question');
        Route::get('quiz/question/{id}/add','QuestionController@add')->name('quiz.questionAdd');
        Route::get('quiz/bulk/{id}/import','QuizController@import')->name('quiz.import');
        Route::post('quiz/bulk/{id}/import','QuizController@saveImport')->name('quiz.saveImport');
        Route::get('quiz/import/download', 'QuizController@downloadTemplate')->name('quiz.downloadTemplate');
        Route::get('quiz/export/{id}', 'QuizController@export')->name('quiz.export');


        Route::get('quiztype/delete/{id}', 'QuizTypeController@destroy')->name('quiztype.destroy');
        Route::get('quiz/delete/{id}', 'QuizController@destroy')->name('quiz.destroy');
        Route::post('quiz/change-status/{id}', 'QuizController@changeStatus');
        Route::get('question/delete/{id}', 'QuestionController@destroy')->name('question.destroy');
        Route::get('quizcategory/delete/{id}', 'QuizCategoryController@destroy')->name('quizcategory.destroy');
        Route::get('classroom/delete/{id}', 'ClassroomController@destroy')->name('classroom.destroy');
        Route::get('collagerclassroom/delete/{id}', 'CollagerClassroomController@destroy')->name('collager-classroom.destroy');

    });

    Route::group(['middleware' => ['role:admin|teacher'],'prefix' => '/table'], function () {
        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('/data-user', 'UserController@getData');
            Route::get('/data-banner', 'BannerController@getData');
            Route::get('/data-version', 'VersionAppController@getData');
            Route::get('/data-school', 'SchoolController@getData');
        });
        Route::get('/data-history', 'HistoryController@getData');
        Route::get('/data-history-user/{id}', 'HistoryController@getDataHistoryUser');
        Route::get('/data-history-chart/{id}', 'HistoryController@getDataChartUser');
        Route::get('/data-quiz-type', 'QuizTypeController@getData');
        Route::get('/data-quiz-category', 'QuizCategoryController@getData');
        Route::get('/data-quiz', 'QuizController@getData');
        Route::get('/data-classroom', 'ClassroomController@getData');
        Route::get('/data-collager-classroom/{id}', 'CollagerClassroomController@getData');
        Route::get('/data-collager-classroom-add/{id}', 'CollagerClassroomController@getDataAdd');
    });

    Route::group(['middleware' => ['role:admin|teacher'],'prefix' => '/select'], function () {
        Route::get('/data-quiz-category', 'QuizCategoryController@getSelect');
        Route::get('/data-quiz-category/{id}', 'QuizCategoryController@getPreSelect');
        Route::get('/data-school', 'SchoolController@getSelect');
        Route::get('/data-school/{id}', 'SchoolController@getPreSelect');
    });
});

Route::group(['middleware' => ['role:admin'],'prefix' => '/search'], function () {
    Route::get('/quiz/{id}', 'QuizController@search')->name('search.action');
});

Route::group(['prefix' => '/storage'], function () {
    Route::get('user/{id}', 'UserController@picture')->name('user.picture');
    Route::get('quiz_type/{id}', 'QuizTypeController@picture')->name('quiztype.picture');
    Route::get('quiz_category/{id}', 'QuizCategoryController@picture')->name('quizcategory.picture');
    Route::get('quiz/{id}', 'QuizController@picture')->name('quiz.picture');
    Route::get('question/{id}', 'QuestionController@picture')->name('question.picture');
    Route::get('answer/{id}', 'AnswerController@picture')->name('answer.picture');
    Route::get('banner/{id}', 'BannerController@picture')->name('banner.picture');

    Route::get('quiz_type/{pictureName}', 'ImageController@pictureType');
    Route::get('quiz_category/{pictureName}', 'ImageController@pictureCategory');
    Route::get('quiz/{pictureName}', 'ImageController@pictureQuiz');
    Route::get('question/{pictureName}', 'ImageController@pictureQuestion');
    Route::get('answer/{pictureName}', 'ImageController@pictureAnswer');
    Route::get('banner/{pictureName}', 'ImageController@pictureBanner');
});
