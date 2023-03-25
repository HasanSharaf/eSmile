<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\UseCases\ListUsers;
use Modules\User\UseCases\CreateUser;
use App\Http\Controllers\Controller as BaseController;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Modules\User\Repositories\UserRepository;
use Modules\User\UseCases\GetCreatorInfo;
use Modules\User\UseCases\ListAgencies;
use Modules\User\UseCases\ListAgents;
use Modules\User\UseCases\ListClients;
use Modules\User\UseCases\ListContactsCrm;

class UserController extends BaseController
{
    private $userRepository;

    /**
     * Class constructor
     *
     **/
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        // $this->authorize('listUsers', User::class);
        $result =  (new ListUsers($this->userRepository))->execute($request);
        return $this->handleResponse($result);
    }

    /**
     * Create a new user.
     * @return Renderable
     */
    public function create(UserRequest $request)
    {
        $this->authorize('create', User::class);
        $result =  (new CreateUser($this->userRepository))->execute($request);
        return $this->handleResponse($result);
    }

    /**
     * List Agencies.
     * @return Renderable
     */
    public function listAgencies(Request $request)
    {
        $result =  (new ListAgencies($this->userRepository))->execute($request);
        return $this->handleResponse($result);
    }
      /**
     * List Agencies.
     * @return Renderable
     */
    public function listClients(Request $request)
    {
        $result =  (new ListClients($this->userRepository))->execute($request);
        return $this->handleResponse($result);
    }
      /**
     * List Agencies.
     * @return Renderable
     */
    public function listContactsCrm(Request $request)
    {
        $result =  (new ListContactsCrm($this->userRepository))->execute($request);
        return $this->handleResponse($result);
    }
      /**
     * List Agencies.
     * @return Renderable
     */
    public function listAgents(Request $request)
    {
        $result =  (new ListAgents($this->userRepository))->execute($request);
        return $this->handleResponse($result);
    }
      /**
     * List Agencies.
     * @return Renderable
     */
    public function getCreatorInfo()
    {
        $result =  (new GetCreatorInfo($this->userRepository))->execute();
        return $this->handleResponse($result);
    }
}
