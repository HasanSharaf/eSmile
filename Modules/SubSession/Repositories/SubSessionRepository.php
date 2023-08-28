<?php

namespace Modules\SubSession\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\Session\Entities\Session;
use Modules\SubSession\Entities\SubSession;
use Modules\User\Entities\User;
use App\Events\SubSessionCreated;
use App\Events\SubSessionCreatedEvent;
use App\Events\SubSessionDeleted;
use App\Events\SubSessionDeletedEvent;
use App\Events\SubSessionUpdated;
use App\Events\SubSessionUpdatedEvent;

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
        try {
            $session = Session::findOrFail($session_id);
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("SESSIONS.SESSION_NOT_FOUND"), 404);
        }

        // Create a new sub session with the session_id and other data
        $subSession = SubSession::create([
            'session_id' => $session_id,
            'paid' => $data['paid'],
            'payment_type' => $data['payment_type'],
            'description' => $data['description'],
        ]);
        
        // Dispatch the event
        event(new SubSessionCreatedEvent($subSession));

        return $subSession;
    }
    

    /**
    * Update SubSession
    * @return SubSession
    */
    public  function updateSubSession($sub_session_id,$data)
    {
        try {
            $subSession = SubSession::findOrFail($sub_session_id);
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("SUB_SESSIONS.SUB_SESSION_NOT_FOUND"), 404);
        }
        $subSession->paid = $data['paid'] ?? $subSession->paid;
        $subSession->payment_type = $data['payment_type'] ?? $subSession->payment_type;
        $subSession->description = $data['description'] ?? $subSession->description;

        $subSession->save();
        event(new SubSessionUpdatedEvent($subSession));
        return $subSession;
    }

    // public function getSessionByUserId($user_id)
    // {
    //     return Session::where('user_id', $user_id)->get();
    // }

    /**
    * Delete SubSession
    * @return SubSession
    */
    public  function deleteSubSession($sub_session_id)
    {
        $subSession = SubSession::findOrFail($sub_session_id);
        if (!$subSession)
            throw new \Exception(Translator::translate("SUB_SESSIONS.SUB_SESSION_NOT_FOUND"), 404);
        $subSession->delete();
        event(new SubSessionDeletedEvent($subSession));
        return $subSession;
    }

    /**
    * Get SubSession By Session Id
    * @return SubSession
    */
    public function getSubSessionBySessionId($session_id)
    {
        return SubSession::whereHas('session', function ($query) use ($session_id) {
            $query->where('session_id', $session_id);
        })->get();
    }

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
