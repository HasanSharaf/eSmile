<?php

namespace App\Observers;

use Modules\Session\Entities\Session;
use Modules\FinancialAccount\Entities\FinancialAccount;

class SessionObserver
{
    public function created(Session $session)
    {
        // Update the related FinancialAccount
        $financialAccount = $session->financialAccount;

        // Calculate the sum of full_cost values from related sessions
        $fullCostSum = $financialAccount->session->sum('full_cost');

        // Calculate the sum of paid values from related sessions
        $paidSum = $financialAccount->session->sum('paid');

        // Calculate the remaining_cost
        $remainingCost = $fullCostSum - $paidSum;

        // Update the financial account's full_cost, paid, and remaining_cost values
        $financialAccount->update([
            'full_cost' => $fullCostSum,
            'paid' => $paidSum,
            'remaining_cost' => $remainingCost,
        ]);
    }
}
