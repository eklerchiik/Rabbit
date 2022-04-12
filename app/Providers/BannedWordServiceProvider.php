<?php

namespace App\Providers;

use App\DTO\BannedWord\BannedWordDTOFactory;
use App\Service\BannedWord\BannedWordVerificationService;
use Illuminate\Support\ServiceProvider;
use App\Service\BannedWord\BannedWordService;

class BannedWordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Services
        $this->app->singleton(BannedWordService::class, function ($app) {
            return new BannedWordService(true, $app->make(BannedWordDTOFactory::class));
        });

        $this->app->singleton(BannedWordVerificationService::class, function ($app) {
            return new BannedWordVerificationService(new BannedWordService(true, $app->make(BannedWordDTOFactory::class)));
        });

        //Factories
        $this->app->singleton(BannedWordDTOFactory::class, function ($app) {
            return new BannedWordDTOFactory();
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
