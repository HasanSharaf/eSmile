<?php

namespace Modules\FinancialAccount\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\FinancialAccount\Repositories\FinancialAccountRepository;
use Modules\FinancialAccount\Http\Resources\FinancialAccountResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;

/**
 * Class CreateFinancialAccount
 *
 * @package Modules\FinancialAccount\UseCases
 */
class CreateFinancialAccount
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
     * Create Session.
     * @return Session
     */
    public function execute($user_id,$data)
    {
        try {
            $session = $this->financialAccountRepository->createFinancialAccount($user_id,$data);
            return new UseCaseResult(ResponseStatus::successCreate, new FinancialAccountResource([$session]), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
