<?php

namespace Modules\Session\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $fillable = [
        'id',
        'appointment_id',
        'full_cost',
        'paid',
        'remaining_cost',
    ];


    public function appointment()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
