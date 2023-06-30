<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Session\Entities\Session;

class SessionCreated
{
    use Dispatchable, SerializesModels;

    public $session;

    /**
     * Create a new event instance.
     *
     * @param  Session  $session
     * @return void
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
}
