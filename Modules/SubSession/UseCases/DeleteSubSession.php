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
 * Class DeleteSubSession
 *
 * @package Modules\SubSession\UseCases
 */
class DeleteSubSession
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
     * Delete SubSession.
     * @return SubSession
     */
    public function execute($sub_session_id)
    {
        try {
            $session = $this->subSessionRepository->deleteSubSession($sub_session_id);
            return new UseCaseResult(ResponseStatus::successCode,(Translator::translate('GENERAL.DELETED_SUCCESSFULLY')), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
