<?php

namespace Modules\Appointment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'id',
        'user_id',
        'selected_time',
        'note',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
