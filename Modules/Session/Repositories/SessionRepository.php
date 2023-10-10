<?php

namespace Modules\Session\Repositories;

use App\Events\SessionCreated;
use App\Events\SessionDeleted;
use App\Events\SessionDeletedEvent;
use App\Events\SessionUpdated;
use App\Helpers\Classes\Translator;
use App\Listeners\SessionCreatedListener;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\Storage;
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
        $sessions = Session::with('doctor')->get();
        $financialAccount = FinancialAccount::where('user_id', $user_id)->first();

        if (!$financialAccount) {
            throw new \Exception("This user doesn't have a financial account. Can't create a new session!");
        }

        // Create a new session with the financial_account_id and user_id
        $createdSession = Session::create([
            'financial_account_id' => $financialAccount->id,
            'user_id' => $user_id,
            'doctor_id' => $data['doctor_id'],
            'full_cost' => $data['full_cost'],
            'payment_type' => $data['payment_type'],
            'description' => $data['description'],
        ]);

        if (isset($data['xray_picture']) && $data['xray_picture']->isValid()) {
            $sessionPicture = $data['xray_picture'];
            $extension = $sessionPicture->getClientOriginalExtension();
            $pictureName = uniqid('sessionPic') . '.' . $extension;
            $sessionPicture->storeAs('public/pictures', $pictureName);
            $createdSession->xray_picture = 'pictures/' . $pictureName;
            $createdSession->save();
        }

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

        event(new SessionCreatedListener($createdSession));

        return $createdSession;
    }
    

    /**
    * Update Session
    * @return Session
    */
    public  function updateSession($session_id,$data)
    {
        try {
            $sessions = Session::with('doctor')->get();
            $session = Session::findOrFail($session_id);
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("SESSIONS.SESSION_NOT_FOUND"), 404);
        }
        $session->doctor_id = $data['doctor_id'] ?? $session->doctor_id;
        $session->full_cost = $data['full_cost'] ?? $session->full_cost;
        $session->paid = $data['paid'] ?? $session->paid;
        $session->remaining_cost = $session->full_cost - $session->paid;
        $session->payment_type = $data['payment_type'] ?? $session->payment_type;
        $session->description = $data['description'] ?? $session->description;

        if (isset($data['xray_picture']) && $data['xray_picture']->isValid()) {
            // Delete the previous session picture if it exists
            if ($session->xray_picture && Storage::exists('public/' . $session->xray_picture)) {
                Storage::delete('public/' . $session->xray_picture);
            }

            $extension = $data['xray_picture']->getClientOriginalExtension();
            $pictureName = uniqid('sessionPic') . '.' . $extension;
            $data['xray_picture']->storeAs('public/pictures', $pictureName);
            $session->xray_picture = 'pictures/' . $pictureName;
        }

        $session->save();

        event(new SessionUpdated($session));

        return $session;
    }

    public function getSessionByUserId($financial_account_id)
    {
        return Session::where('financial_account_id', $financial_account_id)->get();
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
        event(new SessionDeletedEvent($session));
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
        return Session::with(['financialAccount']);
    }


}
