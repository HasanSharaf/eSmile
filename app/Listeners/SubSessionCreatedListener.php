<?php

namespace App\Listeners;

use App\Events\SubSessionCreated;
use App\Events\SubSessionUpdated;
use Modules\Session\Entities\Session;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubSessionCreatedListener
{
    // ...

    public function handle($event)
    {
        $subSession = $event->subSession;
        $session = $subSession->session;

        // Calculate the sum of paid values from related subSessions
        $paidSum = $session->subSession()->sum('paid');

        // Calculate the remaining_cost
        $remainingCost = $session->full_cost - $paidSum;

        // Update the session's paid and remaining_cost values
        $session->update([
            'paid' => $paidSum,
            'remaining_cost' => $remainingCost,
        ]);
    }
}
