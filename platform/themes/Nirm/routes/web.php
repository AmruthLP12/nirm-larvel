<?php

// Custom routes
// You can delete this route group if you don't need to add your custom routes.
Route::group(['namespace' => 'Theme\Nirm\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('/assets/image/{image}', function ($image) {
            return redirect('/themes/nirm/assets/image/'. $image, 301);
        });
    });
});

Theme::routes();

Route::group(['namespace' => 'Theme\Nirm\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('/', 'NirmController@getIndex')
            ->name('public.index');

        Route::get('sitemap.xml', 'NirmController@getSiteMap')
            ->name('public.sitemap');

        Route::get('{slug?}' . config('core.base.general.public_single_ending_url'), 'NirmController@getView')
            ->name('public.single');
    });
});
