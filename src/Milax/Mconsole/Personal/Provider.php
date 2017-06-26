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
        // ..
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Milax\Mconsole\Personal\Contracts\Repositories\PersonRepository', 'Milax\Mconsole\Personal\Repositories\PersonRepository');
    }
}
