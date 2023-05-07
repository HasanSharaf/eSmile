<?php


namespace Modules\User\Models;

class UserSortKey
{
    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PHONE_NUMBER = 'phone_number';
    public const ADDRESS = 'address';
    public const STATUS  = 'status';


    public const DEFAULT_KEY = 'id';
    public const DEFAULT_SORT = 'desc';

    public const KEYS_ARR = [
        self::ID =>[
            'column' => 'id',
        ],
        self::NAME =>[
            'column' => 'name',
        ],
        self::EMAIL =>[
            'column' => 'email',
        ],
        self::PHONE_NUMBER => [
            'column' => 'phone_number',
        ],
        self::ADDRESS =>[
            'column' => 'address',
        ],
        self::STATUS =>[
            'column' => 'status',
        ],
        // self::PHONE_NUMBER => [
        //     'join' => [
        //         'relation' => 'client',
        //         'column' => 'name',
        //         'table' => 'users',
        //         'baseColumn' => 'id',
        //         'joinColumn' =>  'client_id',
        //         'baseTable' => 'financial_coverages'
        //     ]
        // ],
    ];

 
}
