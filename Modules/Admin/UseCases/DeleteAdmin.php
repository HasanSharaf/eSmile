<?php

namespace Modules\Admin\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Http\Resources\AdminResource;
use App\Models\ResponseStatus;

/**
 * Class DeleteAdmin
 *
 * @package Modules\Admin\UseCases
 */
class DeleteAdmin
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
     * Delete Admin.
     * @return Admin
     */
    public function execute($adminId)
    {
        try {
            $admin = $this->adminRepository->deleteAdmin($adminId);
            return new UseCaseResult(ResponseStatus::successCode,(Translator::translate('GENERAL.DELETED_SUCCESSFULLY')), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
