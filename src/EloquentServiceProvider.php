<?php

namespace HtetOoZin\EloquentFilter;

use HtetOoZin\EloquentFilter\Console\Commands\FilterCommand;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FilterCommand::class
            ]);
        }
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
