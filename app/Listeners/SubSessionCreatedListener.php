<?php

namespace App\Listeners;

use App\Events\SubSessionCreatedEvent;
use Modules\Session\Entities\Session;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubSessionCreatedListener
{
    public function handle(SubSessionCreatedEvent $event)
    {
        $subSession = $event->subSession;
        $session = $subSession->session;
        $financialAccount = $session->financialAccount;
    
        // Calculate the sum of paid values from related subSessions for the session
        $paidSum = $session->subSession->sum('paid');
        $remainingCost = $session->full_cost - $paidSum;
    
        // Update the session's paid and remaining_cost values
        $session->update([
            'paid' => $paidSum,
            'remaining_cost' => $remainingCost,
        ]);
    
        // Calculate the sum of paid values from related sessions for the financial account
        $paidSum = $financialAccount->session->sum('paid');
        $fullCostSum = $financialAccount->session->sum('full_cost');
        $remainingCost = $fullCostSum - $paidSum;
    
        // Update the financial account's full_cost, paid, and remaining_cost values
        $financialAccount->update([
            'full_cost' => $fullCostSum,
            'paid' => $paidSum,
            'remaining_cost' => $remainingCost,
        ]);
    }
}
