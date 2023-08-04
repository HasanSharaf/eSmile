<?php

namespace Modules\Admin\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Http\Resources\AdminResource;
use App\Models\ResponseStatus;

/**
 * Class UpdateAdmin
 *
 * @package Modules\Admin\UseCases
 */
class UpdateAdmin
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
     * Update Admin.
     * @return Admin
     */
    public function execute($data,$adminId)
    {
        try {
            $admin = $this->adminRepository->updateAdmin($data,$adminId);
            return new UseCaseResult(ResponseStatus::successCode, new AdminResource([$admin]), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
