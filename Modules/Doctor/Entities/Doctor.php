<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Modules\Appointment\Entities\Appointment;

class Doctor extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'birthday',
        'location',
        'location_details',
        'years_of_experience',
        'type',
        'gender',
        'doctor_picture',
        'competence_type',
        'availability_type'
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

    public function doctorWorkTime()
    {
        return $this->hasMany(DoctorWorkTimes::class);
    }
    
}
