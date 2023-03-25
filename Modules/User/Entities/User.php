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
        'email',
        'password',
        'phone_number',
        'address',
        'status',
        'approved_at',
        'approved_by',
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

}
