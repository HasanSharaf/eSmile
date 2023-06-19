<?php

namespace Modules\SubSession\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Session\Entities\Session;

class SubSession extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $fillable = [
        'id',
        'session_id',
        'paid',
        'payment_type',
        'description',
    ];

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    
}
