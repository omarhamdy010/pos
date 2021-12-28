<?php

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function (){

            Route::get('/index','DashboardController@index')->name('index');


            //      category routes

            Route::resource('/categories','CategoryController')->except(['show']);

            //      products routes

            Route::resource('/products','ProductController')->except(['show']);
            //      user routes

            Route::resource('/clients','ClientController')->except(['show']);

            //      user routes

            Route::resource('/users','UserController')->except(['show']);
        });
});

