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
    * Create Financial Account.
    *
    * @param int   $user_id
    * @param array $data
    * @return FinancialAccount
    */
    public function createFinancialAccount($user_id, $data)
    {
        $user = User::find($user_id);
        $session = FinancialAccount::with('session.doctor')->get();
        if (!$user) {
            throw new \Exception("USERS.USER_NOT_FOUND");
        }

        $financialAccount = FinancialAccount::create([
            'user_id' => $user_id,
            'doctor_id' => $data['doctor_id'],
            'paid' => $data['paid'],
            'full_cost' => $data['full_cost'],
            'remaining_cost' => $data['full_cost'] - $data['paid'] ,
        ]);

        $createdSession = Session::create([
            'financial_account_id' => $financialAccount->id,
            'user_id' => $user_id,
            'doctor_id' => $data['doctor_id'],
            'paid' => $data['paid'],
            'full_cost' => $data['full_cost'],
            'remaining_cost' => $data['full_cost'] - $data['paid'] ,
            'payment_type' => $data['payment_type'],
            'description' => $data['description'],
        ]);

        $subSessionData = [
            'session_id' => $createdSession->id,
            'paid' => $data['paid'],
            'description' => $data['description'],
            'payment_type' => $data['payment_type'],
        ];

        SubSession::create($subSessionData);

        $financialAccount->paid = $data['paid'];
        $financialAccount->remaining_cost = $data['full_cost'] - $data['paid'];
        $financialAccount->save();

        return $createdSession;
    }


    /**
    * Get User Sessions By Id
    * @return FinancialAccount
    */
    public function getUserSessionsById($user_id)
    {
        $sessions = Session::all();
        $filteredSessions = $sessions->filter(function ($session) use ($user_id) {
            return $session->financialAccount->user_id == $user_id;
        });
        return $filteredSessions;
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
