<?php

namespace App\Providers;

use App\DTO\Category\CategoryDTOFactory;
use App\DTO\Post\PostDTOFactory;
use App\DTO\Tag\TagDTOFactory;
use App\DTO\User\UserDTOFactory;
use App\Service\Post\PostService;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Services
        $this->app->singleton(PostService::class, function ($app) {
            return new PostService(true, $app->make(PostDTOFactory::class));
        });

        //Factories
        $this->app->singleton(PostDTOFactory::class, function ($app) {
            return new PostDTOFactory(
                $app->make(TagDTOFactory::class),
                $app->make(CategoryDTOFactory::class),
                $app->make(UserDTOFactory::class)
            );
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
