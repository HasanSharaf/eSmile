<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\SubSession\Entities\SubSession;

class SubSessionCreated
{
    use Dispatchable, SerializesModels;

    public $subSession;

    /**
     * Create a new event instance.
     *
     * @param  SubSession  $subSession
     * @return void
     */
    public function __construct(SubSession $subSession)
    {
        $this->subSession = $subSession;
    }
}
