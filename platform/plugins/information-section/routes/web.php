<?php

Route::group(['namespace' => 'Obii\InformationSection\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'information-sections', 'as' => 'information-section.'], function () {
            Route::resource('', 'InformationSectionController')->parameters(['' => 'information-section'])->only(['edit', 'update']);
            // Route::delete('items/destroy', [
            //     'as'         => 'deletes',
            //     'uses'       => 'InformationSectionController@deletes',
            //     'permission' => 'information-section.destroy',
            // ]);
        });
    });

});
