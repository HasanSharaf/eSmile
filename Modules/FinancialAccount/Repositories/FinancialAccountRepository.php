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
    * Create Session
    * @return Session
    */
    public function createSession($user_id, $data)
    {
        DB::connection()->enableQueryLog();
        try {
            $user = User::findOrFail($user_id);
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("USERS.USER_NOT_FOUND"), 404);
        }
    
        $full_cost = $data['full_cost'];
        $paid = $data['paid'];
    
        $remaining_cost = $full_cost - $paid;
        $data['remaining_cost'] = $remaining_cost;
    
        try {
            $financialAccount = $user->financialAccount;
            // dd($financialAccount);
            if ($financialAccount) {
                $session = $financialAccount->session()->first();
                // dd($session);
                if ($session->full_cost == 0 && $session->paid == 0 && $session->description === null) {
                    // dd('hhhh');
                    // Update existing session with new values
                    $session->update($data);
                    $createdSession = $session;
                } else {
                    // Create a new session and assign the financial_account_id
                    $data['financial_account_id'] = $financialAccount->id;
                    $createdSession = $financialAccount->session()->create($data);
                }
            } else {
                throw new \Exception(Translator::translate("FINANCIAL_ACCOUNT.NOT_FOUND"), 404);
            }
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("SESSIONS.SESSION_CREATION_FAILED"), 500);
        }
    
        return $createdSession;
    }
    


    /**
    * Update Session
    * @return Session
    */
    // public  function updateSession($session_id,$data)
    // {
    //     try {
    //         $session = Session::findOrFail($session_id);
    //     } catch (\Throwable $th) {
    //         throw new \Exception(Translator::translate("SESSIONS.SESSION_NOT_FOUND"), 404);
    //     }
    //     $session->full_cost = $data['full_cost'] ?? $session->full_cost;
    //     $session->paid = $data['paid'] ?? $session->paid;
    //     $session->remaining_cost = $session->full_cost - $session->paid;
    //     $session->payment_type = $data['payment_type'] ?? $session->payment_type;
    //     $session->description = $data['description'] ?? $session->description;

    //     $session->save();
    //     return $session;
    // }

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
    // public function getAllSessions($data, $query)
    // {
    //     return $query->paginate($data['per_page']);
    // }


    /**
     * get Session query.
     * @param Session
     */
    // public function getSessionQuery()
    // {
    //     return Session::with(['user']);
    // }


}
