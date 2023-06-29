<?php

namespace App\Listeners;

use App\Events\SubSessionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubSessionCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SubSessionCreated  $event
     * @return void
     */
    public function handle(SubSessionCreated $event)
    {
        $createdSubSession = $event->subSession;
        $session = $createdSubSession->session;

        // Calculate the sum of paid values from related subSessions
        $paidSum = $session->subSession()->sum('paid');

        // Calculate the remaining_cost
        $remainingCost = $session->full_cost - $paidSum;

        // Update the session's paid and remaining_cost values
        $session->paid = $paidSum;
        $session->remaining_cost = $remainingCost;
        $session->save();
    }
}
