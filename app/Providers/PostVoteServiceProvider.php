<?php

namespace App\Providers;

use App\DTO\PostVote\PostVoteDTOFactory;
use App\Service\PostVote\PostVoteService;
use Illuminate\Support\ServiceProvider;

class PostVoteServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Services
        $this->app->singleton(PostVoteService::class, function ($app) {
            return new PostVoteService(true, $app->make(PostVoteDTOFactory::class));
        });

        //Factories
        $this->app->singleton(PostVoteDTOFactory::class, function ($app) {
            return new PostVoteDTOFactory();
        });
    }
}
