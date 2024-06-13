<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        VideoUploaded::class => [
            SendVideoUploadedNotification::class,
        ],
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        parent::boot();
    }
}
