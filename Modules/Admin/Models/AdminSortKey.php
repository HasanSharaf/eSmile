<?php


namespace Modules\Admin\Models;

class AdminSortKey
{
    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const EMAIL = 'email';
    public const PHONE_NUMBER = 'phone_number';
    public const LOCATION = 'location';


    public const DEFAULT_KEY = 'id';
    public const DEFAULT_SORT = 'desc';

    public const KEYS_ARR = [
        self::ID =>[
            'column' => 'id',
        ],
        self::FIRST_NAME =>[
            'column' => 'first_name',
        ],
        self::LAST_NAME =>[
            'column' => 'last_name',
        ],
        self::EMAIL =>[
            'column' => 'email',
        ],
        self::PHONE_NUMBER => [
            'column' => 'phone_number',
        ],
        self::LOCATION =>[
            'column' => 'location',
        ],
    ];

 
}
