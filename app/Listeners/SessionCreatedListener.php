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

        // Retrieve the related sessions for the financial account
        $relatedSessions = $financialAccount->session;

        // Calculate the sum of full_cost values from related sessions
        $fullCostSum = $relatedSessions->sum('full_cost');

        // Calculate the sum of paid values from related sessions
        $paidSum = $relatedSessions->sum('paid');

        // Calculate the remaining_cost
        $remainingCost = $fullCostSum - $paidSum;

        // Update the financial account's full_cost, paid, and remaining_cost values
        $financialAccount->full_cost = $fullCostSum;
        $financialAccount->paid = $paidSum;
        $financialAccount->remaining_cost = $remainingCost;
        $financialAccount->save();
    }
}
