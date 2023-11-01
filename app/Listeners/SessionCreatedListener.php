<?php

namespace App\Listeners;

use App\Events\SessionCreatedEvent;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SessionCreatedListener
{
    public function handle(SessionCreatedEvent $event)
    {
        $session = $event->session;
        $financialAccount = $session->financialAccount;
        
        $relatedSessions = $financialAccount->session;
        
        $fullCostSum = $relatedSessions->sum('full_cost');
        $paidSum = $relatedSessions->sum('paid');
        $remainingCost = $fullCostSum - $paidSum;
        
        $financialAccount->update([
            'full_cost' => $fullCostSum,
            'paid' => $paidSum,
            'remaining_cost' => $remainingCost,
        ]);
    }
}
