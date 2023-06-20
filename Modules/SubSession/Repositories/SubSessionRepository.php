<?php

namespace Modules\SubSession\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\Session\Entities\Session;
use Modules\SubSession\Entities\SubSession;
use Modules\User\Entities\User;

class SubSessionRepository extends EloquentBaseRepository
{

    // /**
    //  * Get User By Id.
    //  *
    //  */
    // public function getUserById($id)
    // {
    //     $user = User::find($id);
    //     if (!$user)
    //         throw new \Exception(Translator::translate("USER.USER_NOT_FOUND"), 404);

    //     return $user;
    // }

    /**
    * Create SubSession.
    *
    * @param int $session_id
    * @param array $data
    * @return SubSession
    * @throws \Exception
    */
    public function createSubSession($session_id, $data)
    {
        $session = Session::find($session_id);

        if (!$session) {
            throw new \Exception("This session was not found!");
        }

        // Create a new sub session with the session_id and other data
        $subSession = SubSession::create([
            'session_id' => $session_id,
            'paid' => $data['paid'],
            'payment_type' => $data['payment_type'],
            'description' => $data['description'],
        ]);

        return $subSession;
    }
    

    // /**
    // * Update Session
    // * @return Session
    // */
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

    // public function getSessionByUserId($user_id)
    // {
    //     return Session::where('user_id', $user_id)->get();
    // }

    // /**
    // * Delete Session
    // * @return Session
    // */
    // public  function deleteSession($session_id)
    // {
    //     $session = Session::findOrFail($session_id);
    //     if (!$session)
    //         throw new \Exception(Translator::translate("SESSIONS.SESSION_NOT_FOUND"), 404);
    //     $session->delete();
    //     return $session;
    // }

    // /**
    // * List Session
    // * @return Session
    // */
    // public function getAllSessions($data, $query)
    // {
    //     return $query->paginate($data['per_page']);
    // }


    // /**
    //  * get Session query.
    //  * @param Session
    //  */
    // public function getSessionQuery()
    // {
    //     return Session::with(['user']);
    // }


}
