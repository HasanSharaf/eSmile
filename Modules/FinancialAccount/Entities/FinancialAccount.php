<?php

namespace Modules\FinancialAccount\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Session\Entities\Session;

class FinancialAccount extends Model
{
    use HasFactory;
    protected $table = 'financial_accounts';
    protected $with = ['user'];
    protected $fillable = [
        'id',
        'user_id',
        'full_cost',
        'paid',
        'remaining_cost',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function session()
    {
        return $this->hasMany(Session::class);
    }
    
}
