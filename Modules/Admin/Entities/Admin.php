<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'location',
        'birthday',
        'admin_picture',
    ];
    
}
