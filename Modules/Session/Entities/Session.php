<?php

namespace Modules\Session\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;
use Modules\FinancialAccount\Entities\FinancialAccount;
use Modules\SubSession\Entities\SubSession;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $fillable = [
        'id',
        'full_cost',
        'paid',
        'remaining_cost',
        'description',
        'payment_type',
        'financial_account_id',
        'xray_picture',
        'doctor_id',
    ];

    public function financialAccount()
    {
        return $this->belongsTo(FinancialAccount::class, 'financial_account_id');
    }

    public function subSession()
    {
        return $this->hasMany(SubSession::class, 'session_id');
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    
}
