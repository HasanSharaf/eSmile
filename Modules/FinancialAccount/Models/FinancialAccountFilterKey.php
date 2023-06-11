<?php


namespace Modules\FinancialAccount\Models;

use App\Models\EFiltertype;

class FinancialAccountFilterKey
{
    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const EMAIL = 'email';
    public const PHONE_NUMBER = 'phone_number';
    public const LOCATION = 'location';
    public const LOCATION_DETAILS = 'location_details';
    public const GENDER = 'gender';
    public const START_SELECTED_TIME = 'start_selected_time';
    public const END_SELECTED_TIME = 'end_selected_time';
    public const NOTE = 'note';

    public const KEYS_ARR = [
        self::ID =>[
            'type' => EFiltertype::WHERE,
            'column' => 'id',
            'join' => null
        ],
        self::FIRST_NAME => [
            'type' => EFiltertype::WHERE_LIKE,
            'join' => [
                'relation' => 'user',
                'column' => 'first_name'
            ]
        ],
        self::LAST_NAME => [
            'type' => EFiltertype::WHERE_LIKE,
            'join' => [
                'relation' => 'user',
                'column' => 'last_name'
            ]
        ],
        self::EMAIL => [
            'type' => EFiltertype::WHERE_LIKE,
            'join' => [
                'relation' => 'user',
                'column' => 'email'
            ]
        ],
        self::PHONE_NUMBER => [
            'type' => EFiltertype::WHERE,
            'join' => [
                'relation' => 'user',
                'column' => 'phone_number'
            ]
        ],
        self::LOCATION => [
            'type' => EFiltertype::WHERE_LIKE,
            'join' => [
                'relation' => 'user',
                'column' => 'location'
            ]
        ],
        self::LOCATION_DETAILS => [
            'type' => EFiltertype::WHERE_LIKE,
            'join' => [
                'relation' => 'user',
                'column' => 'location_details'
            ]
        ],
        self::GENDER => [
            'type' => EFiltertype::WHERE,
            'join' => [
                'relation' => 'user',
                'column' => 'gender'
            ]
        ],
        self::START_SELECTED_TIME => [
            'type' => EFiltertype::START_DATE,
            'column' => 'selected_time',
            'join' => null
        ],
        self::END_SELECTED_TIME => [
            'type' => EFiltertype::END_DATE,
            'column' => 'selected_time',
            'join' => null
        ],
        self::NOTE =>[
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'note',
            'join' => null
        ],
        // self::QUOTATION_CODE => [
        //     'type' => EFiltertype::WHERE,
        //     'join' => [
        //         'relation' => 'quotations',
        //         'column' => 'quotation_code'
        //     ]
        // ],
    ];

    public const SORTABLE_KEYS =[
        'id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'location',
        'location_details',
        'gender',
        'selected_time',
        'note',
    ];
}
