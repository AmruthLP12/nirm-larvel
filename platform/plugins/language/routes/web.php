<?php

Route::group(['namespace' => 'Obii\Language\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'settings/languages'], function () {
            Route::get('', [
                'as'         => 'languages.index',
                'uses'       => 'LanguageController@index',
                'permission' => false,
            ]);

            Route::post('store', [
                'as'         => 'languages.store',
                'uses'       => 'LanguageController@postStore',
                'permission' => false,
                'middleware' => 'preventDemo',
            ]);

            Route::post('edit', [
                'as'         => 'languages.edit',
                'uses'       => 'LanguageController@update',
                'permission' => false,
                'middleware' => 'preventDemo',
            ]);

            Route::delete('delete/{id}', [
                'as'         => 'languages.destroy',
                'uses'       => 'LanguageController@destroy',
                'permission' => false,
                'middleware' => 'preventDemo',
            ]);

            Route::get('set-default', [
                'as'         => 'languages.set.default',
                'uses'       => 'LanguageController@getSetDefault',
                'permission' => false,
            ]);

            Route::get('get', [
                'as'         => 'languages.get',
                'uses'       => 'LanguageController@getLanguage',
                'permission' => false,
            ]);

            Route::post('edit-setting', [
                'as'         => 'languages.settings',
                'uses'       => 'LanguageController@postEditSettings',
                'permission' => false,
            ]);
        });

    });

    Route::group(['prefix' => 'languages'], function () {

        Route::post('change-item-language', [
            'as'         => 'languages.change.item.language',
            'uses'       => 'LanguageController@postChangeItemLanguage',
            'permission' => false,
        ]);

        Route::get('change-data-language/{locale}', [
            'as'         => 'languages.change.data.language',
            'uses'       => 'LanguageController@getChangeDataLanguage',
            'permission' => false,
        ]);
    });
});
