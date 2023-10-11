<?php

namespace Modules\FinancialAccount\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Session\Entities\Session;
use Modules\Session\Http\Resources\SessionResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Modules\FinancialAccount\Http\Resources\FinancialAccountResource;
use Modules\FinancialAccount\Repositories\FinancialAccountRepository;
use Modules\Session\Http\Resources\UserSessionResource;

/**
 * Class GetUserSessionsById
 *
 * @package Modules\FinancialAccount\UseCases
 */
class GetUserSessionsById
{

   private $financialAccountRepository ;
    /**
    * Class constructor
    *
    **/
    public function __construct(FinancialAccountRepository $financialAccountRepository)
    {
        $this->financialAccountRepository= $financialAccountRepository;
      
    }

    /**
     * Get User Sessions By Id.
     * @return FinancialAccount
     */
    public function execute($user_id)
    {
        try {
            $sessions = $this->financialAccountRepository->getUserSessionsById($user_id);
            return new UseCaseResult(ResponseStatus::successCode, new UserSessionResource($sessions), count([$sessions]), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
