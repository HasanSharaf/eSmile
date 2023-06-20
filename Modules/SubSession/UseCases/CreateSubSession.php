<?php

namespace Modules\SubSession\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\SubSession\Entities\SubSession;
use Modules\SubSession\Repositories\SubSessionRepository;
use Modules\SubSession\Http\Resources\SubSessionResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;

/**
 * Class CreateSubSession
 *
 * @package Modules\SubSession\UseCases
 */
class CreateSubSession
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
     * Create Session.
     * @return Session
     */
    public function execute($session_id,$data)
    {
        try {
            $subSession = $this->subSessionRepository->createSubSession($session_id,$data);
            return new UseCaseResult(ResponseStatus::successCreate, new SubSessionResource([$subSession]), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
