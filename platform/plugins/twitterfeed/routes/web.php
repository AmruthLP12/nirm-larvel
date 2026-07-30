<?php

Route::group(['namespace' => 'Obii\Twitterfeed\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'twitterfeeds', 'as' => 'twitterfeed.'], function () {
            Route::resource('', 'TwitterfeedController')->parameters(['' => 'twitterfeed']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'TwitterfeedController@deletes',
                'permission' => 'twitterfeed.destroy',
            ]);
        });
    });

});
