<?php


namespace App\Helpers\Classes;

use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;

use function PHPUnit\Framework\isNull;
      
class IntegraaAuth extends Auth implements \Illuminate\Contracts\Auth\Guard
{
    protected $user;
    /**
     * @inheritDoc
     */
    public function check()
    {
        return $this->user() !=null;
    }

    /**
     * @inheritDoc
     */
    public function guest()
    {
       return !$this->check();
    }

  
     /**
     * @inheritDoc
     */
    public function hasUser()
    {
       return 1;
    }

   

    /**
     * @inheritDoc
     */
    public function user()
    {
       
        if (app()->environment('local')) {
          
            $user=User::find(1);
            $this->setUser($user);
            //session_write_close();
            //$session_id=request()->cookie(env('INTEGRAA_SESSION_COOKIE'));
           // if(empty($session_id))
          //  return null;
          //  session_id($session_id);
          //  session_start();
           return $this->user;
        }
        //close laravel session
        session_write_close();
        $session_id=request()->cookie(env('INTEGRAA_SESSION_COOKIE'));
        if(empty($session_id))
            return null;
        session_id($session_id);
        session_start();
        if(!array_key_exists('id_soggetto',$_SESSION))
            return null;

        $user_id=$_SESSION['id_soggetto'];
        if(is_null($user_id))
            return null;
        $user=User::find($user_id);
        if(!is_null($user))
        {
            $this->setUser($user);
            return $this->user;
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function id()
    {
       return $this->user->id;
    }

    /**
     * @inheritDoc
     */
    public function validate(array $credentials = [])
    {
    }

    /**
     * @inheritDoc
     */
    public function setUser($user)
    {
        $this->user=$user;
        return $this;
    }
}
