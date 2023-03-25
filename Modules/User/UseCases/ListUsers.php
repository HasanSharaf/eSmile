<?php

namespace Modules\User\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Shared\UseCaseResult;

use Modules\User\Repositories\UserRepository;
use Modules\User\Http\Resources\UserResource;
use App\Models\ResponseStatus;

/**
 * Class ListUsers
 *
 * @package Modules\User\UseCases
 */
class ListUsers
{

    private $userRepository;
    /**
     * Class constructor
     *
     **/
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * get all users.
     * @return UseCaseResult
     */
    public function execute($request)
    {
        try {
            $data = DefaultKeysHelper::execute($request->all());
            $name = $request['name'] ?? null;
            $result = $this->userRepository->getAllUsers($data,$name);
            return new UseCaseResult(ResponseStatus::successCode, new UserResource($result), $result->count(), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug'))
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
}
