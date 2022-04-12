<?php

namespace App\Providers;

use App\DTO\Category\CategoryDTOFactory;
use Illuminate\Support\ServiceProvider;
use App\Service\Category\CategoryService;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Services
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService(true, $app->make(CategoryDTOFactory::class));
        });

        //Factories
        $this->app->singleton(CategoryDTOFactory::class, function ($app) {
            return new CategoryDTOFactory();
        });
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
