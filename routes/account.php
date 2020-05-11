<?php

Route::group(['prefix' => 'account', 'namespace' => 'Account', 'as' => 'account.'], function () {

    Route::post('/login', 'Authentication\UserAuthenticationController@authenticate')->name('authenticate');

    Route::group(['prefix' => 'password', 'namespace' => 'Password', 'as' => 'password.'], function () {
        Route::post('/forget', 'GeneratePasswordResetController@generate')->name('forget');
        Route::post('/reset', 'ResetPasswordController@reset')->name('reset');
    });

    Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {
        Route::get('list', 'ListUsersController@list')->name('list');
    });

});