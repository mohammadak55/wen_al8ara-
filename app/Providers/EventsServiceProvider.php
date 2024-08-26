<?php
namespace App\Providers;

use App\Services\EventService;
use Illuminate\Support\ServiceProvider;

class EventsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EventService::class, function ($app) {
            return new EventService();
        });
    }

    public function boot()
    {
        //
    }
}
