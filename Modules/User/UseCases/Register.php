<?php

namespace Modules\User\UseCases;
 use App\Shared\UseCaseResult;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;
use App\Models\ResponseStatus;

/**
 * Class Register
 *
 * @package Modules\User\UseCases
 */
class Register
{

   private $userRepository ;
    /**
    * Class constructor
    *
    **/
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository= $userRepository;
      
    }

    /**
     * register.
     * @return User
     */
    public function execute($request){
        try {
            $result = $this->userRepository->register($request);
            return new UseCaseResult(ResponseStatus::successCreate,new UserResource($result), $result->count(), '');
        } catch (\Throwable $th) {
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0,$th->getMessage());
        }
      
    }
  

}
