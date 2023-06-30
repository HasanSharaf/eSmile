<?php

namespace App\Listeners;

use App\Events\SessionCreated;
use App\Events\SessionUpdated;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Session\Entities\Session;

class SessionCreatedListener
{
    // ...

    public function handle($event)
    {
        $session = $event->session;
        $financialAccount = $session->financialAccount;

        // Retrieve the user_id from the financial account
        $user_id = $financialAccount->user_id;

        // Retrieve the related sessions for the user
        $relatedSessions = $financialAccount->session;

        // Calculate the sum of full_cost, paid, and remaining_cost from the related sessions
        $totalFullCost = $relatedSessions->sum('full_cost');
        $totalPaid = $relatedSessions->sum('paid');
        $totalRemainingCost = $relatedSessions->sum('remaining_cost');

        // Update the financial account's full_cost, paid, and remaining_cost values
        $financialAccount->full_cost = $totalFullCost;
        $financialAccount->paid = $totalPaid;
        $financialAccount->remaining_cost = $totalRemainingCost;
        $financialAccount->save();
    }
}
