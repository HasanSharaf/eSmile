<?php

namespace Modules\User\UseCases;

 use App\Shared\UseCaseResult;
 use App\Models\ResponseStatus;
use Modules\Quotation\Models\EQuotationClientType;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;

/**
 * Class ListClients
 *
 * @package Modules\User\UseCases
 */
class ListClients 
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
    public function execute($data){
        try {
            $agencyId = $data->get('agency_id');
            $name = $data->get('name');
            $result = $this->userRepository->listUsers(EQuotationClientType::CLIENT,$agencyId,$name);
            return new UseCaseResult(ResponseStatus::successCode,new UserResource($result), $result->count(), '');
        } catch (\Throwable $th) {
           $message = $th->getMessage();
            if(config('app.debug'))
            $message .= ' in file: '.$th->getFile() . ' line: '. $th->getLine();
           return new UseCaseResult( ResponseStatus::baseErrorCode, null, 0,$message);
        }
      
    }
}