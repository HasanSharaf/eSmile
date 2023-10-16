<?php

namespace Modules\Session\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Session\Entities\Session;
use Modules\Session\Repositories\SessionRepository;
use Modules\Session\Http\Resources\SessionResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Modules\Session\Http\Resources\UserSessionResource;

/**
 * Class GetSessionsByUserId
 *
 * @package Modules\Session\UseCases
 */
class GetSessionsByUserId
{

   private $sessionRepository ;
    /**
    * Class constructor
    *
    **/
    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository= $sessionRepository;
      
    }

    /**
     * Get Sessions By User Id.
     * @return Session
     */
    public function execute($user_id)
    {
        try {
            $appointments = $this->sessionRepository->getSessionByUserId($user_id);
            return new UseCaseResult(ResponseStatus::successCode, new UserSessionResource($appointments), count($appointments), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
