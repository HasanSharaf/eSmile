<?php

namespace Modules\Admin\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Http\Resources\AdminResource;
use App\Models\ResponseStatus;
use Modules\Admin\Http\Resources\AdminLoginResource;

/**
 * Class LogoutAdmin
 *
 * @package Modules\Admin\UseCases
 */
class LogoutAdmin
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
     * logoutAdmin.
     * @return Admin
     */
    public function execute($request)
    {
        try {
            $admin = $this->adminRepository->logoutAdmin($request);
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
