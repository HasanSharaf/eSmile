<?php

namespace Modules\Session\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Modules\Session\Entities\Session;
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
    * Create Session
    * @return Session
    */
    public  function createSession($user_id,$data)
    {
        try {
            $user = User::findOrFail($user_id);
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("USER.USER_NOT_FOUND"), 404);
        }
    
        $full_cost = $data['full_cost'];
        $paid = $data['paid'];
    
        $remaining_cost = $full_cost - $paid;
        $data['remaining_cost'] = $remaining_cost;
    
        $createdSession = $user->session()->create($data);
    
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
