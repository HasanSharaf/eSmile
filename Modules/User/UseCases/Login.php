<?php

namespace Modules\User\UseCases;
 use App\Shared\UseCaseResult;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;
use App\Models\ResponseStatus;
use Modules\User\Http\Resources\UserLoginResource;

/**
 * Class Login
 *
 * @package Modules\User\UseCases
 */
class Login
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
     * login.
     * @return User
     */
    public function execute($request)
    {
        try {
            $user = $this->userRepository->login($request);
            $token = $user->createToken('token-name')->plainTextToken;
           
            return new UseCaseResult(ResponseStatus::successCode, [new UserResource([$user]),'token' => $token], 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            // return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
            return response()->json(['error' => $message], 500);
        }
    }
  

}
