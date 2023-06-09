<?php

namespace Modules\FinancialAccount\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\FinancialAccount\Http\Requests\FinancialAccountRequest;
use Modules\FinancialAccount\Http\Requests\UpdateFinancialAccountRequest;
use Modules\FinancialAccount\Repositories\FinancialAccountRepository;
use Modules\FinancialAccount\UseCases\CreateFinancialAccount;
use Modules\FinancialAccount\UseCases\CreateSession;
use Modules\FinancialAccount\UseCases\DeleteFinancialAccount;
use Modules\FinancialAccount\UseCases\GetFinancialAccountsByUserId;
use Modules\FinancialAccount\UseCases\GetUserSessionsById;
use Modules\FinancialAccount\UseCases\ListFinancialAccounts;
use Modules\Session\Http\Requests\SessionRequest;

class FinancialAccountController extends Controller
{
    private $financialAccountRepository;
    
    /**
     * Class constructor
     *
     **/
    public function __construct(FinancialAccountRepository $financialAccountRepository)
    {
        $this->financialAccountRepository = $financialAccountRepository;
        
    
    }

    /**
    * Create Session.
    * @return Response
    */
    public function createFinancialAccount($user_id, SessionRequest $request,CreateFinancialAccount $createFinancialAccount)
    {
        $result = $createFinancialAccount->execute($user_id, $request->all());
        return $this->handleResponse($result);
    }

    /**
    * Delete Financial Account.
    * @return Response
    */
    public function deleteFinancialAccount($financial_account_id, DeleteFinancialAccount $deleteFinancialAccount)
    {
        $result = $deleteFinancialAccount->execute($financial_account_id);
        return $this->handleResponse($result);
        
    }

    /**
    * Get User Sessions.
    * @return Response
    */
    public function getUserSessions($user_id, GetUserSessionsById $getUserSessionsById)
    {
        $result = $getUserSessionsById->execute($user_id);
        return $this->handleResponse($result);
    }

    /**
    * List Financial Accounts.
    * @return Response
    */
    public function listFinancialAccounts(Request $request, ListFinancialAccounts $listFinancialAccounts)
    {
        $sessions = $listFinancialAccounts->execute($request->all());
        return $this->handleResponse($sessions);
    }
}
