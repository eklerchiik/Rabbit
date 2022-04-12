<?php

namespace App\Providers;

use App\DTO\Comment\CommentDTOFactory;
use App\DTO\User\UserDTOFactory;
use App\Service\Comment\CommentService;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Services
        $this->app->singleton(CommentService::class, function ($app) {
            return new CommentService(true, $app->make(CommentDTOFactory::class));
        });

        //Factories
        $this->app->singleton(CommentDTOFactory::class, function ($app) {
            return new CommentDTOFactory($app->make(UserDTOFactory::class));
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
