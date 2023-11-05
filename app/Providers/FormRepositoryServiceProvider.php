<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\FormRepositoryInterface;
use App\Repositories\EloquentFormRepository;

class FormRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FormRepositoryInterface::class, EloquentFormRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
