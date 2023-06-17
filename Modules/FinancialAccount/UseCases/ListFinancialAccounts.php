<?php

namespace Modules\FinancialAccount\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Helpers\Classes\FilterHelper;
use App\Helpers\Classes\SearchQueryHelper;
use App\Helpers\Classes\SortHelper;
use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\FinancialAccount\Repositories\FinancialAccountRepository;
use Modules\FinancialAccount\Http\Resources\FinancialAccountResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\ToArray;
use Modules\FinancialAccount\Http\Resources\listFinancialAccountResource;
use Modules\FinancialAccount\Models\FinancialAccountFilterKey;
use Modules\FinancialAccount\Models\FinancialAccountSortKey;

/**
 * Class ListFinancialAccount
 *
 * @package Modules\FinancialAccount\UseCases
 */
class ListFinancialAccounts
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
     * List FinancialAccount.
     * @return FinancialAccount
     */
    public function execute($request)
    {
        try {
            $data = DefaultKeysHelper::execute($request);
            $query = $this->financialAccountRepository->getFinancialAccountQuery();
            $filter_data = SearchQueryHelper::execute($request, ['full_cost', 'paid', 'remaining_cost', 'payment_type', 'description', 'first_name', 'last_name', 'gender', 'phone_number']);
            $filterQuery = FilterHelper::filter($filter_data, FinancialAccountFilterKey::KEYS_ARR, $query);
            $sortQuery = SortHelper::sort($data['order_key'], $data['order'], FinancialAccountSortKey::KEYS_ARR, $filterQuery);

            $result = $this->financialAccountRepository->getAllFinancialAccounts($data, $sortQuery);
            return new UseCaseResult(ResponseStatus::successCode, new FinancialAccountResource($result, false), $result->count(), '');
            
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
