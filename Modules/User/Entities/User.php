<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Appointment\Entities\Appointment;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\Session\Entities\Session;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    protected $table = 'users';
    protected $fillable = [
        'financial_account_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'birthday',
        'location',
        'location_details',
        'gender',
        'user_picture',
        'approved_at',
        'clinic_knowledge',
        'clinic_note',
        'sickness',
        'sensitive',
        'sensitive_note',
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

    public function financialAccount()
    {
        return $this->belongsTo(FinancialAccount::class, 'financial_account_id');
    }


}
