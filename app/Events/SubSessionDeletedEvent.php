<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\SubSession\Entities\SubSession;

class SubSessionDeletedEvent
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