<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Modules\Appointment\Entities\Appointment;

class DoctorWorkTimes extends Model
{
    use HasFactory;
    protected $table = 'doctor_work_times';
    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
