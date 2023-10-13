<?php

namespace Modules\Appointment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'id',
        'user_id',
        'doctor_id',
        'selected_date',
        'selected_time',
        'note',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    
}
