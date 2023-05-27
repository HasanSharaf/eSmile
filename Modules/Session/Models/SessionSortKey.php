<?php


namespace Modules\Session\Models;

class SessionSortKey
{
    public const ID = 'id';
    public const APPOINTMENT_ID = 'appointment_id';
    public const FULL_COST = 'full_cost';
    public const PAID = 'paid';
    public const REMAINING_COST = 'remaining_cost';


    public const DEFAULT_KEY = 'id';
    public const DEFAULT_SORT = 'desc';

    public const KEYS_ARR = [
        self::ID =>[
            'column' => 'id',
        ],
        self::APPOINTMENT_ID => [
            'join' => [
                'relation' => 'appointment',
                'column' => 'id',
                'table' => 'appointments',
                'baseColumn' => 'id',
                'joinColumn' =>  'appointment_id',
                'baseTable' => 'sessions'
            ]
        ],
        self::FULL_COST =>[
            'column' => 'full_cost',
        ],
        self::PAID =>[
            'column' => 'paid',
        ],
        self::REMAINING_COST =>[
            'column' => 'remaining_cost',
        ],
    ];

 
}
