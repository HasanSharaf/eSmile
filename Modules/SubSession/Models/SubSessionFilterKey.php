<?php


namespace Modules\SubSession\Models;

use App\Models\EFiltertype;

class SubSessionFilterKey
{
    public const ID = 'id';
    public const SESSION_ID = 'session_id';
    public const PAID = 'paid';
    public const DESCRIPTION = 'description';
    public const PAYMENT_TYPE = 'payment_type';

    public const KEYS_ARR = [
        self::ID =>[
            'type' => EFiltertype::WHERE,
            'column' => 'id',
            'join' => null
        ],
        self::SESSION_ID => [
            'type' => EFiltertype::WHERE,
            'join' => [
                'relation' => 'session',
                'column' => 'id'
            ]
        ],
        self::PAID => [
            'type' => EFiltertype::WHERE,
            'column' => 'paid',
            'join' => null
        ],
        self::DESCRIPTION => [
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'description',
            'join' => null
        ],
        self::PAYMENT_TYPE => [
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'payment_type',
            'join' => null
        ],
    ];

    public const SORTABLE_KEYS =[
        'id',
        'session_id',
        'paid',
        'description',
        'payment_type',
    ];
}
