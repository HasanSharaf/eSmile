<?php

namespace App\Providers;

use App\Events\SessionCreated;
use App\Events\SessionCreatedEvent;
use App\Events\SessionUpdated;
use App\Events\SessionDeletedEvent;
use App\Events\SubSessionCreated;
use App\Events\SubSessionCreatedEvent;
use App\Events\SubSessionUpdated;
use App\Events\SubSessionUpdatedEvent;
use App\Listeners\SessionCreatedListener;
use App\Listeners\SessionDeletedListener;
use App\Listeners\SubSessionCreatedListener;
use App\Listeners\SubSessionDeletedListener;
use App\Listeners\SubSessionUpdatedListener;
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
        SessionCreatedEvent::class => [
            SessionCreatedListener::class,
        ],
        // SessionUpdated::class => [
        //     SessionCreatedListener::class,
        // ],
        SessionDeletedEvent::class => [
            SessionDeletedListener::class,
        ],
        SubSessionCreatedEvent::class => [
            SubSessionCreatedListener::class,
        ],
        SubSessionUpdatedEvent::class => [
            SubSessionUpdatedListener::class,
        ],
        SubSessionDeletedEvent::class => [
            SubSessionDeletedListener::class,
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
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
