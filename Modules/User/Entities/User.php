<?php

namespace Modules\User\Entities;

use App\Helpers\Classes\PermissionHolder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Modules\Integraa\Entities\UserPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\PriceList\Entities\PriceList;
use Modules\Quotation\Entities\DefaultFixedItem;
use Modules\Quotation\Entities\FixedItem;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'tipo',
        'typology',
        'integraa_id',
        'financial_status',
        'email',
        'parent_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


  

    public function userCan($permission)
    {
        return PermissionHolder::getInstance()->checkPermission($permission);
    }

    public function userFixedItem()
    {
        return $this->hasMany(FixedItem::class);
    }

    public function defaultFixedItem()
    {
        return $this->hasMany(DefaultFixedItem::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'integraa_id');
    }
    /**
     * @return bool
     * according to integraa network code
     */
    public function isAdmin()
    {
        return false; //FIXME:
        if (app()->environment('local')) {
            return true;
        }
        return $_SESSION['livello'] == 'A';
    }

    public function priceList()
    {
        return $this->hasMany(PriceList::class,'client_id')->with('priceListProduct');
    }
    public function confirmRequest()
    {
        return $this->hasMany(ConfirmRequest::class);
    }
}
