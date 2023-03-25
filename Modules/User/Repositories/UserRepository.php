<?php

namespace Modules\User\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentBaseRepository;
use App\Repositories\EloquentRepositoryInterface;
use Modules\Quotation\Models\EQuotationClientType;
use Modules\User\Entities\User;

class UserRepository extends EloquentBaseRepository
{


    /**
     * get all user.
     * @return User
     */
    public  function getAllUsers($data, $name)
    {

        $query =  $this->model->query()
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        return $query->paginate($data['per_page']);
    }


    /**
     * edit a  user.
     * @param Request $request
     * @return user
     */
    public function edit($data, $id)
    {
        $user = $this->model->find($id)->update([]);
        return $user;
    }

    /**
     * delet a  user.
     * @param Request $request
     * @return User
     */
    public function deleteUser($id)
    {
        $user = $this->model->find($id)->delete();
        return $user;
    }

    /**
     * get a user by id.
     * @return User
     */
    public  function getUserById($id)
    {
        $user = $this->model->find($id);
        if (!$user)
            throw new \Exception(Translator::translate('USERS.USER_NOT_FOUND'), 404);

        return  $user;
    }

    /**
     * Get List of users
     * @return User
     */
    public function listQuotationIntialdata()
    {
        $result = $this->model->whereIn('tipo', EQuotationClientType::CLIENT_TYPES_ARR)->select('id', 'name', 'vat', 'tipo')->get();
        return  $result;
    }

    /**
     * get a user by id.
     * @return User
     */
    public  function getFirstUser()
    {
        $user = $this->model->first();
        if (!$user)
            throw new \Exception(Translator::translate('USERS.USER_NOT_FOUND'), 404);

        return  $user;
    }

    /**
     * list users by type.
     * @param string $type
     * @return User
     */
    public  function listUsers($type,$name=null,$agencyId = null)
    {
        $users = $this->model->with('parent')->where(['tipo' => $type]);
        if($agencyId){
            $users->where('parent_id',$agencyId);
        }
        if($name){
            $users->where('name', 'like', '%' . $name . '%')->orWhere('vat', 'like',$name . '%');
        }
        $users = $users->get();
        return  $users;
    }

    public function listUsersAgencies($type,$name)
    {
        $users = $this->model->where(['tipo' => $type])->where('integraa_id', '!=', 1);
        if($name){
            $users->where('name', 'like', '%' . $name . '%')->orWhere('vat', 'like',$name . '%');
        }
        $users = $users->get();
        return  $users;
    }
}
