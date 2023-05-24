<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Repositories\UserRepository;
use Modules\User\UseCases\DeleteUser;
use Modules\User\UseCases\GetAllUsers;
use Modules\User\UseCases\GetUserById;
use Modules\User\UseCases\Login;
use Modules\User\UseCases\Logout;
use Modules\User\UseCases\Register;
use Modules\User\UseCases\UpdateUser;

class UserController extends Controller
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
    * Create User (Register).
    * @return Response
    */
    public function register(RegisterRequest $request, Register $register)
    {
        $data = $request->validated();
        $data['picture'] = $request->file('picture'); // Get the uploaded picture file
        $result = $register->execute($request);
        return $this->handleResponse($result);
    }

    /**
    * Login User.
    * @return Response
    */
    public function login(LoginRequest $request, Login $login)
    {
        $result = $login->execute($request);
        return $this->handleResponse($result);
    }

    /**
    * Logout User.
    * @return Response
    */
    public function logout(Request $request, Logout $logout)
    {
        $result = $logout->execute($request);
        return $this->handleResponse($result);
        
    }

    /**
    * Update User.
    * @return Response
    */
    public function updateUser(UpdateUserRequest $request, $userId, UpdateUser $updateUser)
    {
        $result = $updateUser->execute($request,$userId);
        return $this->handleResponse($result);
        
    }

    /**
    * Delete User.
    * @return Response
    */
    public function deleteUser($userId, DeleteUser $deleteUser)
    {
        $result = $deleteUser->execute($userId);
        return $this->handleResponse($result);
        
    }

    /**
    * Get All Users.
    * @return Response
    */
    public function getAllUsers(Request $request, GetAllUsers $getAllUsers)
    {
        $result = $getAllUsers->execute($request->all());
        return $this->handleResponse($result);
        
    }

    /**
    * Get User By Id.
    * @return Response
    */
    public function getUserById(Request $request, $userId,GetUserById $getUserById)
    {
        $result = $getUserById->execute($request,$userId);
        return $this->handleResponse($result);
        
    }


}
