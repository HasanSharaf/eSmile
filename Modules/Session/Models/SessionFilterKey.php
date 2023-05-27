<?php


namespace Modules\Session\Models;

use App\Models\EFiltertype;

class SessionFilterKey
{
    public const ID = 'id';
    public const APPOINTMENT_ID = 'appointment_id';
    public const FULL_COST = 'full_cost';
    public const PAID = 'paid';
    public const REMAINING_COST = 'remaining_cost';

    public const KEYS_ARR = [
        self::ID =>[
            'type' => EFiltertype::WHERE,
            'column' => 'id',
            'join' => null
        ],
        self::APPOINTMENT_ID => [
            'type' => EFiltertype::WHERE,
            'join' => [
                'relation' => 'appointment',
                'column' => 'id'
            ]
        ],
        self::FULL_COST => [
            'type' => EFiltertype::WHERE,
            'column' => 'full_cost',
            'join' => null
        ],
        self::PAID => [
            'type' => EFiltertype::WHERE,
            'column' => 'paid',
            'join' => null
        ],
        self::REMAINING_COST => [
            'type' => EFiltertype::WHERE,
            'column' => 'remaining_cost',
            'join' => null
        ],
    ];

    public const SORTABLE_KEYS =[
        'id',
        'appointment_id',
        'full_cost',
        'paid',
        'remaining_cost',
    ];
}
