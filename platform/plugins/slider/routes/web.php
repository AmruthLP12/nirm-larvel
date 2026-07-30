<?php

Route::group(['namespace' => 'Obii\Slider\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'sliders', 'as' => 'slider.'], function () {
            Route::resource('', 'SliderController')->parameters(['' => 'slider']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'SliderController@deletes',
                'permission' => 'slider.destroy',
            ]);
        });
    });

});
