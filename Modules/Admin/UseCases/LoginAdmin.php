<?php

namespace Modules\Admin\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Http\Resources\AdminResource;
use App\Models\ResponseStatus;
use Modules\Admin\Http\Resources\AdminLoginResource;

/**
 * Class LoginAdmin
 *
 * @package Modules\Admin\UseCases
 */
class LoginAdmin
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
     * loginAdmin.
     * @return Admin
     */
    public function execute($request)
    {
        try {
            $admin = $this->adminRepository->loginAdmin($request);
            $token = $admin->createToken('token-name')->plainTextToken;
           
            return new UseCaseResult(ResponseStatus::successCode, [new AdminResource([$admin]),'token' => $token], 1, '');
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
