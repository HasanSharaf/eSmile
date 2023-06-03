<?php

namespace Modules\Session\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Session\Http\Requests\SessionRequest;
use Modules\Session\Http\Requests\UpdateSessionRequest;
use Modules\Session\Repositories\SessionRepository;
use Modules\Session\UseCases\CreateSession;
use Modules\Session\UseCases\DeleteSession;
use Modules\Session\UseCases\GetSessionsByUserId;
use Modules\Session\UseCases\ListSessions;
use Modules\Session\UseCases\UpdateSession;

class SessionController extends Controller
{
    private $sessionRepository;
    
    /**
     * Class constructor
     *
     **/
    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
        
    
    }

    /**
    * Create Session.
    * @return Response
    */
    public function createSession($user_id, SessionRequest $request,CreateSession $createSession)
    {
        $result = $createSession->execute($user_id, $request->all());
        return $this->handleResponse($result);
    }

    /**
    * Update Session.
    * @return Response
    */
    public function updateSession($session_id, UpdateSessionRequest $request,UpdateSession $updateSession)
    {
        $result = $updateSession->execute($session_id, $request->all());
        return $this->handleResponse($result);
    }

    /**
    * Delete Session.
    * @return Response
    */
    public function deleteSession($session_id, DeleteSession $deleteSession)
    {
        $result = $deleteSession->execute($session_id);
        return $this->handleResponse($result);
        
    }

    /**
    * Get User Sessions.
    * @return Response
    */
    public function getUserSessions($user_id, GetSessionsByUserId $getSessionsByUserId)
    {
        $result = $getSessionsByUserId->execute($user_id);
        return $this->handleResponse($result);
    }

    /**
    * List Session.
    * @return Response
    */
    public function listSessions(Request $request, ListSessions $listSessions)
    {
        $sessions = $listSessions->execute($request->all());
        return $this->handleResponse($sessions);
    }
}
