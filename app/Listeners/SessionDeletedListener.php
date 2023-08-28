<?php

namespace App\Listeners;

use App\Events\SessionDeletedEvent;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Session\Entities\Session;

class SessionDeletedListener
{
    /**
     * Handle the SessionDeletedEvent.
     *
     * @param  SessionDeletedEvent  $event
     * @return void
     */
    public function handle(SessionDeletedEvent $event)
    {
        $session = $event->session;
        $financialAccount = $session->financialAccount;
    
        // Retrieve the related sessions for the financial account
        $relatedSessions = Session::where('financial_account_id', $financialAccount->id)->get();
    
        // Calculate the sum of paid values from related sessions
        $paidSum = $relatedSessions->sum('paid');
    
        // Calculate the sum of full_cost values from related sessions
        $fullCostSum = $relatedSessions->sum('full_cost');
    
        // Calculate the remaining_cost
        $remainingCost = $fullCostSum - $paidSum;
    
        // Update the financial account's full_cost, paid, and remaining_cost values
        $financialAccount->full_cost = $fullCostSum;
        $financialAccount->paid = $paidSum;
        $financialAccount->remaining_cost = $remainingCost;
        $financialAccount->save();
    }
}