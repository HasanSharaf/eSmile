<?php


namespace Modules\Session\Models;

use App\Models\EFiltertype;

class SessionFilterKey
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const FULL_COST = 'full_cost';
    public const PAID = 'paid';
    public const REMAINING_COST = 'remaining_cost';
    public const DESCRIPTION = 'description';
    public const PAYMENT_TYPE = 'payment_type';

    public const KEYS_ARR = [
        self::ID =>[
            'type' => EFiltertype::WHERE,
            'column' => 'id',
            'join' => null
        ],
        self::USER_ID => [
            'type' => EFiltertype::WHERE,
            'join' => [
                'relation' => 'user',
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
        'user_id',
        'full_cost',
        'paid',
        'remaining_cost',
        'description',
        'payment_type',
    ];
}
