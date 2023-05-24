<?php

namespace Modules\User\UseCases;
 use App\Shared\UseCaseResult;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;
use App\Models\ResponseStatus;

/**
 * Class GetUserById
 *
 * @package Modules\User\UseCases
 */
class GetUserById
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
     * Get User By Id.
     * @return User
     */
    public function execute($data,$userId)
    {
        try {
            $user = $this->userRepository->getUserById($data,$userId);
            return new UseCaseResult(ResponseStatus::successCode, new UserResource([$user]), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }

}
