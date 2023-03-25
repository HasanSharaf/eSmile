<?php

namespace Modules\User\UseCases;

 use App\Shared\UseCaseResult;
 use App\Models\ResponseStatus;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;

/**
 * Class GetCreatorInfo
 *
 * @package Modules\User\UseCases
 */
class GetCreatorInfo 
{
 private $userRepository ;
       /**
     * Class constructor
     *
     **/
    public function __construct(UserRepository $userRepository )
    {
        $this->userRepository = $userRepository;
      
    }

     /**
     *  user.
     *  @param
     * @return UseCaseResult
     */
    public function execute(){
        try {
            $creator = ['creator' => auth()->user() ?? User::select('id', 'name')->first()]; //TODO: get user from auth and Remove this line
            return new UseCaseResult(ResponseStatus::successCode,new UserResource($creator), 1, '');
        } catch (\Throwable $th) {
           $message = $th->getMessage();
            if(config('app.debug'))
            $message .= ' in file: '.$th->getFile() . ' line: '. $th->getLine();
           return new UseCaseResult( ResponseStatus::baseErrorCode, null, 0,$message);
        }
      
    }
}