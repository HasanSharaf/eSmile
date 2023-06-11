<?php

namespace Modules\Session\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\FinancialAccount\Entities\FinancialAccount;

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
    ];

    public function financialAccount()
    {
        return $this->belongsTo(FinancialAccount::class, 'financial_account_id');
    }
    
}
