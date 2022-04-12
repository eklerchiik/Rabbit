<?php

namespace App\Providers;

use App\DTO\Vote\VoteDTOFactory;
use App\Service\Vote\VoteService;
use Illuminate\Support\ServiceProvider;

class VoteServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Services
        $this->app->singleton(VoteService::class, function ($app) {
            return new VoteService(true, $app->make(VoteDTOFactory::class));
        });

        //Factories
        $this->app->singleton(VoteDTOFactory::class, function ($app) {
            return new VoteDTOFactory();
        });
    }
}
