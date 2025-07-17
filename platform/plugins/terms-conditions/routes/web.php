<?php

Route::group(['namespace' => 'Obii\TermsConditions\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'terms-conditions', 'as' => 'terms-conditions.'], function () {
            Route::resource('', 'TermsConditionsController')->parameters(['' => 'terms-conditions']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'TermsConditionsController@deletes',
                'permission' => 'terms-conditions.destroy',
            ]);
        });
    });
    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
            Route::get('terms-and-conditions', 'PublicController@index')
                ->name('public.terms-and-conditions');
            Route::post('terms-and-conditions', 'PublicController@store')
                ->name('public.terms-and-conditions.store');
        });
    }
});
