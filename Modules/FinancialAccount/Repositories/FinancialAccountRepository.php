<?php

namespace Modules\FinancialAccount\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Session\Entities\Session;
use Modules\User\Entities\User;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\SubSession\Entities\SubSession;

class FinancialAccountRepository extends EloquentBaseRepository
{

    /**
     * Get Fixed Item.
     *
     */
    // public function getUserById($id)
    // {
    //     $user = User::find($id);
    //     if (!$user)
    //         throw new \Exception(Translator::translate("USER.USER_NOT_FOUND"), 404);

    //     return $user;
    // }

    /**
    * Create Financial Account.
    *
    * @param int   $user_id
    * @param array $data
    * @return FinancialAccount
    */
    public function createFinancialAccount($user_id, $data)
    {
    // Check if the user exists
    $user = User::find($user_id);
    if (!$user) {
        throw new \Exception("USERS.USER_NOT_FOUND");
    }

    // Create a new financial account for the user
    $financialAccount = FinancialAccount::create([
        'user_id' => $user_id,
    ]);

    // Create a new session with the financial_account_id and user_id
    $createdSession = Session::create([
        'financial_account_id' => $financialAccount->id,
        'user_id' => $user_id,
        'full_cost' => $data['full_cost'],
        'payment_type' => $data['payment_type'],
        'description' => $data['description'],
    ]);

    // Create a new subSession with the paid value, description, and payment_type from the input data
    $subSessionData = [
        'session_id' => $createdSession->id,
        'paid' => $data['paid'],
        'description' => $data['description'],
        'payment_type' => $data['payment_type'],
    ];

    SubSession::create($subSessionData);

    // Update the paid and remaining_cost values in the session
    $createdSession->update([
        'paid' => $createdSession->subSession()->sum('paid'),
        'remaining_cost' => $createdSession->full_cost - $createdSession->subSession()->sum('paid'),
    ]);

    return $createdSession;
    }


    /**
    * Get User Sessions By Id
    * @return FinancialAccount
    */
    public function getUserSessionsById($user_id)
    {
        return Session::whereHas('financialAccount', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
    }

    /**
    * Delete Session
    * @return Session
    */
    public  function deleteFinancialAccount($financial_account_id)
    {
        $financialAccount = FinancialAccount::findOrFail($financial_account_id);
        if (!$financialAccount)
            throw new \Exception(Translator::translate("FINANCIAL_ACCOUNTS.FINANCIAL_ACCOUNT_NOT_FOUND"), 404);
        $financialAccount->delete();
        return $financialAccount;
    }

    /**
    * List Session
    * @return Session
    */
    public function getAllFinancialAccounts($data, $query)
    {
        return $query->paginate($data['per_page']);
    }


    /**
    * get FinancialAccount query.
    * @param FinancialAccount
    */
    public function getFinancialAccountQuery()
    {
        return FinancialAccount::with(['user', 'session']);
    }


}
