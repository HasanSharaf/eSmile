<?php 

namespace App\Listeners;

use App\Events\SubSessionDeletedEvent;
use Modules\Session\Entities\Session;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubSessionDeletedListener
{
    /**
     * Handle the SubSessionDeletedEvent.
     *
     * @param  SubSessionDeletedEvent  $event
     * @return void
     */
    public function handle(SubSessionDeletedEvent $event)
    {
        $subSession = $event->subSession;
        $session = $subSession->session;

        // Calculate the sum of paid values from related subSessions
        $paidSum = $session->subSession()->sum('paid');

        // Calculate the remaining_cost
        $remainingCost = $session->full_cost - $paidSum;

        // Update the session's paid and remaining_cost values
        $session->paid = $paidSum;
        $session->remaining_cost = $remainingCost;
        $session->save();

        // Update the financial account's remaining_cost value
        $financialAccount = $session->financialAccount;
        $financialAccountPaidSum = $financialAccount->session()->sum('paid');
        $financialAccountRemainingCost = $financialAccount->full_cost - $financialAccountPaidSum;
        $financialAccount->remaining_cost = $financialAccountRemainingCost;
        $financialAccount->save();
    }
}