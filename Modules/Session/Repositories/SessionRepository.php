<?php

namespace Modules\Session\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\Session\Entities\Session;
use Modules\SubSession\Entities\SubSession;
use Modules\User\Entities\User;

class SessionRepository extends EloquentBaseRepository
{

    /**
     * Get Fixed Item.
     *
     */
    public function getUserById($id)
    {
        $user = User::find($id);
        if (!$user)
            throw new \Exception(Translator::translate("USER.USER_NOT_FOUND"), 404);

        return $user;
    }

    /**
    * Create Session.
    *
    * @param int   $user_id
    * @param array $data
    * @return Session
    * @throws \Exception
    */
    public function createSession($user_id, $data)
    {
        $financialAccount = FinancialAccount::where('user_id', $user_id)->first();

        if (!$financialAccount) {
            throw new \Exception("This user doesn't have a financial account. Can't create a new session!");
        }

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
    * Update Session
    * @return Session
    */
    public  function updateSession($session_id,$data)
    {
        try {
            $session = Session::findOrFail($session_id);
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("SESSIONS.SESSION_NOT_FOUND"), 404);
        }
        $session->full_cost = $data['full_cost'] ?? $session->full_cost;
        $session->paid = $data['paid'] ?? $session->paid;
        $session->remaining_cost = $session->full_cost - $session->paid;
        $session->payment_type = $data['payment_type'] ?? $session->payment_type;
        $session->description = $data['description'] ?? $session->description;

        $session->save();
        return $session;
    }

    public function getSessionByUserId($user_id)
    {
        return Session::where('user_id', $user_id)->get();
    }

    /**
    * Delete Session
    * @return Session
    */
    public  function deleteSession($session_id)
    {
        $session = Session::findOrFail($session_id);
        if (!$session)
            throw new \Exception(Translator::translate("SESSIONS.SESSION_NOT_FOUND"), 404);
        $session->delete();
        return $session;
    }

    /**
    * List Session
    * @return Session
    */
    public function getAllSessions($data, $query)
    {
        return $query->paginate($data['per_page']);
    }


    /**
     * get Session query.
     * @param Session
     */
    public function getSessionQuery()
    {
        return Session::with(['user']);
    }


}
