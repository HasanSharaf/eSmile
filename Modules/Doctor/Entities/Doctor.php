<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

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
        'gender',
        'doctor_picture',

    ];
    
}
