<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use App\Listeners\UserLoginSuccessful;
use App\Listeners\ResizeImageUploadedLFM;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ImageWasUploaded::class => [
            ResizeImageUploadedLFM::class,
        ],
        Login::class => [
            UserLoginSuccessful::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
