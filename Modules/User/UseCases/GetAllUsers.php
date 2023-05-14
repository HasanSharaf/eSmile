<?php

namespace Modules\User\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Helpers\Classes\FilterHelper;
use App\Helpers\Classes\SearchQueryHelper;
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
            $data = DefaultKeysHelper::execute($request);
            $query = $this->userRepository->getUserQuery();
            $filter_data = SearchQueryHelper::execute($request, ['first_name', 'last_name', 'email', 'phone_number', 'gender', 'location', 'location_details']);
            $filterQuery = FilterHelper::filter($filter_data, UserFilterKey::KEYS_ARR, $query);
            $sortQuery = SortHelper::sort($data['order_key'], $data['order'], UserSortKey::KEYS_ARR, $filterQuery);
            $result = $this->userRepository->getAllUsers($data, $sortQuery);
            return new UseCaseResult(ResponseStatus::successCode, new UserResource($result, false), $result->count(), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
