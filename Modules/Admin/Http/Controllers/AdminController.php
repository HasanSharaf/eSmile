<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\CreateAdminRequest;
use Modules\Admin\Http\Requests\LoginAdminRequest;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\UseCases\CreateAdmin;
use Modules\Admin\UseCases\DeleteAdmin;
use Modules\Admin\UseCases\GetAdminById;
use Modules\Admin\UseCases\GetAllAdmins;
use Modules\Admin\UseCases\LoginAdmin;
use Modules\Admin\UseCases\LogoutAdmin;
use Modules\Admin\UseCases\UpdateAdmin;

class AdminController extends Controller
{
    private $adminRepository;
    
    /**
     * Class constructor
     *
     **/
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
    * Create Admin.
    * @return Response
    */
    public function createAdmin(CreateAdminRequest $request ,CreateAdmin $createAdmin)
    {
        $result = $createAdmin->execute($request);
        return $this->handleResponse($result);
    }

    /**
    * Login Admin.
    * @return Response
    */
    public function loginAdmin(LoginAdminRequest $request, LoginAdmin $loginAdmin)
    {
        $result = $loginAdmin->execute($request);
        return $this->handleResponse($result);
    }

    /**
    * Logout Admin.
    * @return Response
    */
    public function logoutAdmin(Request $request, LogoutAdmin $logoutAdmin)
    {
        $result = $logoutAdmin->execute($request);
        return $this->handleResponse($result);
        
    }

    /**
    * Update Admin.
    * @return Response
    */
    public function updateAdmin(CreateAdminRequest $request , $admin_id,UpdateAdmin $updateAdmin)
    {
        $result = $updateAdmin->execute($request, $admin_id);
        return $this->handleResponse($result);
    }

    /**
    * Get Admin By Id.
    * @return Response
    */
    public function getAdminById($admin_id, GetAdminById $getAdminById)
    {
        $result = $getAdminById->execute($admin_id);
        return $this->handleResponse($result);
    }

    /**
    * Delete Admin.
    * @return Response
    */
    public function deleteAdmin($id, DeleteAdmin $deleteAdmin)
    {
        $result = $deleteAdmin->execute($id);
        return $this->handleResponse($result);
    }

    /**
    * List Admins.
    * @return Response
    */
    public function getAllAdmins(Request $request, GetAllAdmins $getAllAdmins)
    {
        $admins = $getAllAdmins->execute($request->all());
        return $this->handleResponse($admins);
    }

}
