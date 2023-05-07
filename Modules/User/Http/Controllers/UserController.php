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
        $result = $getAllUsers->execute($request);
        return $this->handleResponse($result);
        
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
