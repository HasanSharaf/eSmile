<?php

namespace Modules\Session\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Modules\Session\Entities\Session;
use Modules\User\Entities\User;

class SessionRepository extends EloquentBaseRepository
{
    /**
    * Create Session
    * @return Session
    */
    public  function createSession($data)
    {
        // Retrieve user details
        // $user = User::where('id', $data['user_id'])->firstOrFail();
        
        // Create Session
        // $appointment = Session::create([
        //     'user_id' => $user->id,
        //     'selected_time' => $data['selected_time'],
        //     'note' => $data['note'],
        // ]);

        // return $appointment;
    }

    public function getSessionByUserId($user_id)
    {
        // return Session::where('user_id', $user_id)->get();
    }

    /**
    * Delete Session
    * @return Session
    */
    public  function deleteSession($id)
    {
        $session = Session::find($id);
        if (!$session)
            // throw new \Exception(Translator::translate("APPOINTMENTS.APPOINTMENT_NOT_FOUND"), 404);
        $session->delete();
        return $session;
    }

    /**
    * List Session
    * @return Session
    */
    public function getAllSessions($data, $query)
    {
        // return $query->paginate($data['per_page']);
    }


    /**
     * get Session query.
     * @param Session
     */
    public function getSessionQuery()
    {
        // return Session::with(['user']);
    }


}
