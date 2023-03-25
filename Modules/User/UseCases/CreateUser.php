<?php

namespace Modules\User\UseCases;
 use App\Shared\UseCaseResult;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;
use App\Models\ResponseStatus;

/**
 * Class UserManager
 *
 * @package Modules\User\UseCases
 */
class CreateUser
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
     * get all users.
     * @return User
     */
    public function execute( $user){
        try {
            $result = $this->userRepository->create($user);
            return new UseCaseResult(ResponseStatus::successCode,new UserResource($result), $result->count(), '');
        } catch (\Throwable $th) {
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0,$th->getMessage());
        }
      
    }
  

}
