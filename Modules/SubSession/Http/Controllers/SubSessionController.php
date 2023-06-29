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
use Modules\SubSession\UseCases\GetSubSessionBySessionId;
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

    /**
    * Update SubSession.
    * @return Response
    */
    public function updateSubSession($sub_session_id, UpdateSubSessionRequest $request,UpdateSubSession $updateSubSession)
    {
        $result = $updateSubSession->execute($sub_session_id, $request->all());
        return $this->handleResponse($result);
    }

    /**
    * Delete SubSession.
    * @return Response
    */
    public function deleteSubSession($sub_session_id, DeleteSubSession $deleteSubSession)
    {
        $result = $deleteSubSession->execute($sub_session_id);
        return $this->handleResponse($result);
        
    }

    /**
    * Get SubSession By Session Id.
    * @return Response
    */
    public function getSubSessionBySessionId($session_id, GetSubSessionBySessionId $getSubSessionBySessionId)
    {
        $result = $getSubSessionBySessionId->execute($session_id);
        return $this->handleResponse($result);
    }

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
