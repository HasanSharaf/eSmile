<?php


namespace Modules\Doctor\Models;

use App\Models\EFiltertype;

class DoctorFilterKey
{
    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const EMAIL = 'email';
    public const PHONE_NUMBER = 'phone_number';
    public const LOCATION = 'location';
    public const LOCATION_DETAILS = 'location_details';
    public const GENDER = 'gender';
    public const YEARS_OF_EXPERIENCE = 'years_of_experience';

    public const KEYS_ARR = [
        self::ID =>[
            'type' => EFiltertype::WHERE,
            'column' => 'id',
            'join' => null
        ],
        self::FIRST_NAME =>[
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'first_name',
            'join' => null
        ],
        self::LAST_NAME =>[
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'last_name',
            'join' => null
        ],
        self::EMAIL => [
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'email',
            'join' => null
        ],
        self::PHONE_NUMBER =>[
            'type' => EFiltertype::WHERE,
            'column' => 'phone_number',
            'join' => null
        ],
        self::LOCATION =>[
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'location',
            'join' => null
        ],
        self::LOCATION_DETAILS =>[
            'type' => EFiltertype::WHERE_LIKE,
            'column' => 'location_detailss',
            'join' => null
        ],
        self::GENDER =>[
            'type' => EFiltertype::WHERE,
            'column' => 'gender',
            'join' => null
        ],
        self::YEARS_OF_EXPERIENCE =>[
            'type' => EFiltertype::WHERE,
            'column' => 'years_of_experience',
            'join' => null
        ],
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
        'years_of_experience',
    ];
}
