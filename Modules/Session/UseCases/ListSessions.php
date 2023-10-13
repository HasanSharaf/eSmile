<?php

namespace Modules\Session\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Helpers\Classes\FilterHelper;
use App\Helpers\Classes\SearchQueryHelper;
use App\Helpers\Classes\SortHelper;
use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Session\Entities\Session;
use Modules\Session\Repositories\SessionRepository;
use Modules\Session\Http\Resources\SessionResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\ToArray;
use Modules\Session\Http\Resources\UserSessionResource;
use Modules\Session\Models\SessionFilterKey;
use Modules\Session\Models\SessionSortKey;

/**
 * Class ListSession
 *
 * @package Modules\Session\UseCases
 */
class ListSessions
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
     * List Session.
     * @return Session
     */
    public function execute($request)
    {
        try {
            $data = DefaultKeysHelper::execute($request);
            $query = $this->sessionRepository->getSessionQuery();
            $filter_data = SearchQueryHelper::execute($request, ['full_cost', 'paid', 'remaining_cost', 'payment_type', 'description']);
            $filterQuery = FilterHelper::filter($filter_data, SessionFilterKey::KEYS_ARR, $query);
            $sortQuery = SortHelper::sort($data['order_key'], $data['order'], SessionSortKey::KEYS_ARR, $filterQuery);

            $result = $this->sessionRepository->getAllSessions($data, $sortQuery);
            return new UseCaseResult(ResponseStatus::successCode, new UserSessionResource($result, false), $result->count(), '');
            
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
