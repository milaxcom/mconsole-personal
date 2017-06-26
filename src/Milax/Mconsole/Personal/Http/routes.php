<?php

/**
 * Personal module routes file
 */
Route::group([
    'prefix' => config('mconsole.url'),
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'App\Mconsole\Personal\Http\Controllers',
], function () {
    
    Route::resource('/personal', 'PersonalController');

});
