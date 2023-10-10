<?php

namespace Modules\Session\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Session\Entities\Session;
use Modules\Session\Repositories\SessionRepository;
use Modules\Session\Http\Resources\SessionResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;

/**
 * Class CreateSession
 *
 * @package Modules\Session\UseCases
 */
class CreateSession
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
     * Create Session.
     * @return Session
     */
    public function execute($user_id, $data)
    {
        try {
            $session = $this->sessionRepository->createSession($user_id, $data);
            return new UseCaseResult(ResponseStatus::successCreate, new SessionResource([$session]), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
