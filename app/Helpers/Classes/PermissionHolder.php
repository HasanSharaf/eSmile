<?php
namespace App\Helpers\Classes;

/**
 * define as a singltune to
 */
class PermissionHolder{

    private static $instance;
    public  $permissions;

    public function __construct()
    {
        $this->permissions=[];
    }

    /**
     * @param array $permissions
     */
    public function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance=new PermissionHolder();
        }
        return self::$instance;
    }

    public  function checkPermission($permission)
    {
        return
            array_key_exists($permission,$this->getPermissions())
            &&
            $this->getPermissions()[$permission]==1;
    }
}
