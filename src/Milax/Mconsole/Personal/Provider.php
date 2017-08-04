<?php

namespace Milax\Mconsole\Personal;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('mconsole::personal.form', function ($view) {
            $view->with('languages', app('Milax\Mconsole\Contracts\Repositories\LanguagesRepository')->get());
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
