<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->hasHeader('Authorization')) {
            Broadcast::routes(['prefix' => 'api','middleware' => ['jwt.auth','api']]);
        } else {
            Broadcast::routes(['prefix' => 'api','middleware' => ['web']]);
        }

        require base_path('routes/channels.php');
    }
}
