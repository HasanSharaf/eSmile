<?php

namespace Modules\User\UseCases;
 use App\Shared\UseCaseResult;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;
use App\Models\ResponseStatus;
use Modules\User\Http\Resources\UserLoginResource;

/**
 * Class Logout
 *
 * @package Modules\User\UseCases
 */
class Logout
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
     * logout.
     * @return User
     */
    public function execute($request)
    {
        try {
            $user = $this->userRepository->logout($request);
            return new UseCaseResult(ResponseStatus::successCode, 1, 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return response()->json(['error' => $message], 500);
        }
    }
  

}
