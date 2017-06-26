<?php

/**
 * Personal module routes file
 */
Route::group([
    'prefix' => config('mconsole.url'),
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Personal\Http\Controllers',
], function () {
    
    Route::resource('/personal', 'PersonalController');

});
