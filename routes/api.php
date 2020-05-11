<?php

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

Route::group(['middleware' => 'api', 'prefix' => 'v1', 'as' => 'api.'], function () {

    require __DIR__ . '/account.php';

    Route::group(['middleware' => 'valid.token'], function () {

        Route::post('task/{id}/timer/start', 'Tasks\TimeTrackerController@start')->name('task.timer.start');
        Route::post('task/{id}/timer/stop', 'Tasks\TimeTrackerController@stop')->name('task.timer.stop');
        Route::post('task/{id}/complete', 'Tasks\TimeTrackerController@completeTask')->name('task.complete');

        require __DIR__ . '/crud.php';
    });

});
