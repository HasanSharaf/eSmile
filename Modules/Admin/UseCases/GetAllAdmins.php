<?php

namespace Modules\Admin\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Helpers\Classes\FilterHelper;
use App\Helpers\Classes\SearchQueryHelper;
use App\Helpers\Classes\SortHelper;
use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Http\Resources\AdminResource;
use App\Models\ResponseStatus;
use Modules\Admin\Models\AdminFilterKey;
use Modules\Admin\Models\AdminSortKey;

/**
 * Class GetALlAdmins
 *
 * @package Modules\Admin\UseCases
 */
class GetAllAdmins
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
     * Get All Admins.
     * @return Admin
     */
    public function execute($request)
    {
        try {
            $data = DefaultKeysHelper::execute($request);
            $query = $this->adminRepository->getAdminQuery();
            $filter_data = SearchQueryHelper::execute($request, ['first_name', 'last_name', 'email', 'phone_number', 'location']);
            $filterQuery = FilterHelper::filter($filter_data, AdminFilterKey::KEYS_ARR, $query);
            $sortQuery = SortHelper::sort($data['order_key'], $data['order'], AdminSortKey::KEYS_ARR, $filterQuery);
            $result = $this->adminRepository->getAllAdmins($data, $sortQuery);
            return new UseCaseResult(ResponseStatus::successCode, new AdminResource($result, false), $result->count(), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
