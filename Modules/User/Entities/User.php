<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
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


}
