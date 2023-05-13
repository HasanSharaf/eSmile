<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Appointment\Entities\Appointment;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

 protected $table = 'users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'location',
        'location_details',
        'gender',
        'approved_at',
        'approved_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }


}
