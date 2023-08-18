<?php

namespace Modules\Admin\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Http\Resources\AdminResource;
use App\Models\ResponseStatus;

/**
 * Class create Admin
 *
 * @package Modules\Admin\UseCases
 */
class CreateAdmin
{

   private $adminRepository ;
    /**
    * Class constructor
    *
    **/
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository= $adminRepository;
      
    }

    /**
     * Create Admin.
     * @return Admin
     */
    public function execute($request)
    {
        try {
            $admin = $this->adminRepository->createAdmin($request);
            $token = $admin->createToken('token-name')->plainTextToken;

            return new UseCaseResult(ResponseStatus::successCreate, [new AdminResource([$admin]),'token' => $token], 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
