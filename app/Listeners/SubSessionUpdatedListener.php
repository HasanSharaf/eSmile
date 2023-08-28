<?php 

namespace App\Listeners;

use App\Events\SubSessionUpdatedEvent;
use App\Models\Session;
use App\Models\FinancialAccount;

class SubSessionUpdatedListener
{
    public function handle(SubSessionUpdatedEvent $event)
    {
        $subSession = $event->subSession;
        $session = $subSession->session;
        $financialAccount = $session->financialAccount;

        // Recalculate paid value for the session
        $paidSum = $session->subSession->sum('paid');
        $remainingCost = $session->full_cost - $paidSum;

        // Update the session's paid and remaining_cost values
        $session->update([
            'paid' => $paidSum,
            'remaining_cost' => $remainingCost,
        ]);

        // Recalculate paid value for the financial account
        $paidSum = $financialAccount->session->sum('paid');
        $remainingCost = $financialAccount->full_cost - $paidSum;

        // Update the financial account's paid and remaining_cost values
        $financialAccount->update([
            'paid' => $paidSum,
            'remaining_cost' => $remainingCost,
        ]);
    }
}