<?php

namespace App\Providers;

use App\Events\SessionCreated;
use App\Events\SessionUpdated;
use App\Events\SubSessionCreated;
use App\Events\SubSessionUpdated;
use App\Listeners\SessionCreatedListener;
use App\Listeners\SubSessionCreatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SessionCreated::class => [
            SessionCreatedListener::class,
        ],
        SessionUpdated::class => [
            SessionCreatedListener::class,
        ],
        SubSessionCreated::class => [
            SubSessionCreatedListener::class,
        ],
        SubSessionUpdated::class => [
            SubSessionCreatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
