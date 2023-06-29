<?php

namespace Modules\SubSession\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\SubSession\Entities\SubSession;
use Modules\SubSession\Http\Resources\SubSessionResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Modules\SubSession\Repositories\SubSessionRepository;

/**
 * Class GetSubSessionBySessionId
 *
 * @package Modules\SubSession\UseCases
 */
class GetSubSessionBySessionId
{

   private $subSessionRepository ;
    /**
    * Class constructor
    *
    **/
    public function __construct(SubSessionRepository $subSessionRepository)
    {
        $this->subSessionRepository= $subSessionRepository;
      
    }

    /**
     * Get SubSession By Seeion Id.
     * @return SubSession
     */
    public function execute($session_id)
    {
        try {
            $subSessions = $this->subSessionRepository->getSubSessionBySessionId($session_id);
            return new UseCaseResult(ResponseStatus::successCode, new SubSessionResource($subSessions), count([$subSessions]), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
