<?php

namespace Modules\FinancialAccount\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Session\Entities\Session;
use Modules\User\Entities\User;
use Modules\FinancialAccount\Entities\FinancialAccount;

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
        // Create a new row in the financial_accounts table
        $financialAccountData = [
            'user_id' => $user_id,
        ];
        $financialAccount = FinancialAccount::create($financialAccountData);

        // Create a new session with specific property values
        $sessionData = [
            'full_cost' => $data['full_cost'],
            'paid' => $data['paid'],
            'remaining_cost' => $data['full_cost'] - $data['paid'],
            'payment_type' => $data['payment_type'],
            'description' => $data['description'],
            'financial_account_id' => $financialAccount->id,
        ];
        $createdSession = Session::create($sessionData);

        return $financialAccount;
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
