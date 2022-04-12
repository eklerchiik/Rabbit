<?php

namespace App\Providers;

use App\DTO\Tag\TagDTOFactory;
use Illuminate\Support\ServiceProvider;
use App\Service\Tag\TagService;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Services
        $this->app->singleton(TagService::class, function ($app) {
            return new TagService(true, $app->make(TagDTOFactory::class));
        });

        //Factories
        $this->app->singleton(TagDTOFactory::class, function ($app) {
            return new TagDTOFactory();
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
