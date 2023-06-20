<?php

namespace Modules\SubSession\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\SubSession\Http\Requests\SubSessionRequest;
use Modules\SubSession\Http\Requests\UpdateSubSessionRequest;
use Modules\SubSession\Repositories\SubSessionRepository;
use Modules\SubSession\UseCases\CreateSubSession;
use Modules\SubSession\UseCases\DeleteSubSession;
use Modules\SubSession\UseCases\GetSubSessionsByUserId;
use Modules\SubSession\UseCases\ListSubSessions;
use Modules\SubSession\UseCases\UpdateSubSession;

class SubSessionController extends Controller
{
    private $subSessionRepository;
    
    /**
     * Class constructor
     *
     **/
    public function __construct(SubSessionRepository $subSessionRepository)
    {
        $this->subSessionRepository = $subSessionRepository;
        
    
    }

    /**
    * Create Session.
    * @return Response
    */
    public function createSubSession($session_id, SubSessionRequest $request,CreateSubSession $createSubSession)
    {
        $result = $createSubSession->execute($session_id, $request->all());
        return $this->handleResponse($result);
    }

    // /**
    // * Update Session.
    // * @return Response
    // */
    // public function updateSession($session_id, UpdateSessionRequest $request,UpdateSession $updateSession)
    // {
    //     $result = $updateSession->execute($session_id, $request->all());
    //     return $this->handleResponse($result);
    // }

    // /**
    // * Delete Session.
    // * @return Response
    // */
    // public function deleteSession($session_id, DeleteSession $deleteSession)
    // {
    //     $result = $deleteSession->execute($session_id);
    //     return $this->handleResponse($result);
        
    // }

    // /**
    // * Get User Sessions.
    // * @return Response
    // */
    // public function getUserSessions($user_id, GetSessionsByUserId $getSessionsByUserId)
    // {
    //     $result = $getSessionsByUserId->execute($user_id);
    //     return $this->handleResponse($result);
    // }

    // /**
    // * List Session.
    // * @return Response
    // */
    // public function listSessions(Request $request, ListSessions $listSessions)
    // {
    //     $sessions = $listSessions->execute($request->all());
    //     return $this->handleResponse($sessions);
    // }
}
