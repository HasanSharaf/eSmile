<?php

namespace Modules\User\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Helpers\Classes\FilterHelper;
use App\Helpers\Classes\SortHelper;
use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;
use App\Models\ResponseStatus;
use Modules\User\Models\UserFilterKey;
use Modules\User\Models\UserSortKey;

/**
 * Class GetALlUsers
 *
 * @package Modules\User\UseCases
 */
class GetAllUsers
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
     * Get All Users.
     * @return User
     */
    public function execute($request)
    {
        try {
            $data = DefaultKeysHelper::execute($request->all());
            $query = $this->userRepository->getUserQuery();
            $filterQuery = FilterHelper::filter($request->all(), UserFilterKey::KEYS_ARR, $query);
            // dd($filterQuery);
            $sortQuery = SortHelper::sort($data['order_key'], $data['order'], UserSortKey::KEYS_ARR, $filterQuery);
            $result = $this->userRepository->getPaginationDataByQuery($data, $sortQuery);
            // $user = $this->userRepository->getAllUsers($userId);
            return new UseCaseResult(ResponseStatus::successCode, (new UserResource($result))->getResult($data,$result), $result->count(), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
