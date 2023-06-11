<?php

namespace Modules\FinancialAccount\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Session\Entities\Session;
use Modules\Session\Repositories\SessionRepository;
use Modules\Session\Http\Resources\SessionResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Modules\FinancialAccount\Repositories\FinancialAccountRepository;

/**
 * Class DeleteFinancialAccount
 *
 * @package Modules\FinancialAccount\UseCases
 */
class DeleteFinancialAccount
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
     * Delete Financial Account
     * @return FinancialAccount
     */
    public function execute($financial_account_id)
    {
        try {
            $session = $this->financialAccountRepository->deleteFinancialAccount($financial_account_id);
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
