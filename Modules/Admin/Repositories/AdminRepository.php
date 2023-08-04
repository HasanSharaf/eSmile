<?php

namespace Modules\Admin\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Entities\Admin;
use Modules\User\Entities\User;

class AdminRepository extends EloquentBaseRepository
{
    /**
    * Create Admin
    * @return Admin
    */
    public  function createAdmin($data)
    {
        $admin = Admin::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'location' => $data['location'],
        ]);
    
        if ($data->hasFile('admin_picture') && $data->file('admin_picture')->isValid()) {
            $adminPicture = $data->file('admin_picture');
            $extension = $adminPicture->getClientOriginalExtension();
            $pictureName = uniqid('adminPic') . '.' . $extension;
            $adminPicture->storeAs('public/pictures', $pictureName);
            $admin->admin_picture = 'pictures/' . $pictureName;
            $admin->save();
        }

        return $admin;
        // $token = $user->createToken('token-name')->plainTextToken;
        
        // return [
        //     "user" => $user,
        //     "token" => $token,
        // ];
    }

    /**
    * Login Admin
    * @return Admin
    */
    public  function loginAdmin($request)
    {
        $admin = Admin::where('email', $request['email'])->first();
        return $admin;
    }

    /**
    * Logout Admin
    * @return Admin
    */
    public  function logoutAdmin()
    {
        $logoutAdmin = Auth::logout();
        return $logoutAdmin;
    }

    /**
    * Update Admin
    * @return Admin
    */
    public function updateAdmin($data, $adminId)
    {
        $admin = Admin::findOrFail($adminId);
        $admin->first_name = $data['first_name'] ?? $admin->first_name;
        $admin->last_name = $data['last_name'] ?? $admin->last_name;
        $admin->email = $data['email'] ?? $admin->email;
        $admin->password = Hash::make($data['password']) ?? $admin->password;
        $admin->phone_number = $data['phone_number'] ?? $admin->phone_number;
        $admin->location = $data['location'] ?? $admin->location;
        $admin->birthday = $data['birthday'] ?? $admin->birthday;

        if (isset($data['admin_picture']) && $data['admin_picture']->isValid()) {
            // Delete the previous admin picture if it exists
            if ($admin->admin_picture && Storage::exists('public/' . $admin->admin_picture)) {
                Storage::delete('public/' . $admin->admin_picture);
            }

            $extension = $data['admin_picture']->getClientOriginalExtension();
            $pictureName = uniqid('adminPic') . '.' . $extension;
            $data['admin_picture']->storeAs('public/pictures', $pictureName);
            $admin->admin_picture = 'pictures/' . $pictureName;
        }

        $admin->save();
        return $admin;
    }

    public function getAdminById($admin_id)
    {
        $admin = Admin::findOrFail($admin_id);
        return $admin;
    }

    /**
    * Delete Admin
    * @return Admin
    */
    public  function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        if (!$admin)
            throw new \Exception(Translator::translate("ADMINS.ADMIN_NOT_FOUND"), 404);
        $admin->delete();
        return $admin;
    }

    /**
    * get All Admin
    * @return Admin
    */
    public function getAllAdmins($data, $query)
    {
        return $query->paginate($data['per_page']);
    }


    /**
     * Get Admin Query.
     * @param Admin
     */
    public function getAdminQuery()
    {
        return Admin::first();
    }


}
