<?php


namespace Modules\Session\Models;

class SessionSortKey
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const FULL_COST = 'full_cost';
    public const PAID = 'paid';
    public const REMAINING_COST = 'remaining_cost';
    public const DESCRIPTION = 'description';
    public const PAYMENT_TYPE = 'payment_type';

    public const DEFAULT_KEY = 'id';
    public const DEFAULT_SORT = 'desc';

    public const KEYS_ARR = [
        self::ID =>[
            'column' => 'id',
        ],
        self::USER_ID => [
            'join' => [
                'relation' => 'user',
                'column' => 'id',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
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
        self::DESCRIPTION =>[
            'column' => 'description',
        ],
        self::PAYMENT_TYPE =>[
            'column' => 'payment_type',
        ],
    ];

 
}
