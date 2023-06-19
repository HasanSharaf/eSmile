<?php


namespace Modules\SubSession\Models;

class SubSessionSortKey
{
    public const ID = 'id';
    public const SESSION_ID = 'session_id';
    public const PAID = 'paid';
    public const DESCRIPTION = 'description';
    public const PAYMENT_TYPE = 'payment_type';

    public const DEFAULT_KEY = 'id';
    public const DEFAULT_SORT = 'desc';

    public const KEYS_ARR = [
        self::ID =>[
            'column' => 'id',
        ],
        self::SESSION_ID => [
            'join' => [
                'relation' => 'session',
                'column' => 'id',
                'table' => 'sessions',
                'baseColumn' => 'id',
                'joinColumn' =>  'session_id',
                'baseTable' => 'sub_sessions'
            ]
        ],
        self::PAID =>[
            'column' => 'paid',
        ],
        self::DESCRIPTION =>[
            'column' => 'description',
        ],
        self::PAYMENT_TYPE =>[
            'column' => 'payment_type',
        ],
    ];

 
}
