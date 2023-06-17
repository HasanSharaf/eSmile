<?php


namespace Modules\FinancialAccount\Models;

class FinancialAccountSortKey
{
    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const EMAIL = 'email';
    public const PHONE_NUMBER = 'phone_number';
    public const LOCATION = 'location';
    public const LOCATION_DETAILS = 'location_details';
    public const GENDER = 'gender';
    public const SELECTED_TIME = 'selected_time';
    public const NOTE = 'note';
    public const FULL_COST = 'full_cost';
    public const PAID = 'paid';
    public const REMAINING_COST = 'remaining_cost';
    public const DESCRIPTION = 'description';


    public const DEFAULT_KEY = 'id';
    public const DEFAULT_SORT = 'desc';

    public const KEYS_ARR = [
        self::ID =>[
            'column' => 'id',
        ],
        self::FIRST_NAME => [
            'join' => [
                'relation' => 'user',
                'column' => 'first_name',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::LAST_NAME => [
            'join' => [
                'relation' => 'user',
                'column' => 'last_name',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::EMAIL => [
            'join' => [
                'relation' => 'user',
                'column' => 'email',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::PHONE_NUMBER => [
            'join' => [
                'relation' => 'user',
                'column' => 'phone_number',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::LOCATION => [
            'join' => [
                'relation' => 'user',
                'column' => 'location',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::LOCATION_DETAILS => [
            'join' => [
                'relation' => 'user',
                'column' => 'location_details',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::GENDER => [
            'join' => [
                'relation' => 'user',
                'column' => 'gender',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::SELECTED_TIME =>[
            'join' => [
                'relation' => 'user',
                'column' => 'selected_time',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::NOTE =>[
            'join' => [
                'relation' => 'user',
                'column' => 'note',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::FULL_COST =>[
            'join' => [
                'relation' => 'user',
                'column' => 'full_cost',
                'table' => 'sessions',
                'baseColumn' => 'id',
                'joinColumn' =>  'session_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::PAID =>[
            'join' => [
                'relation' => 'user',
                'column' => 'paid',
                'table' => 'sessions',
                'baseColumn' => 'id',
                'joinColumn' =>  'session_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::REMAINING_COST =>[
            'join' => [
                'relation' => 'user',
                'column' => 'remaining_cost',
                'table' => 'sessions',
                'baseColumn' => 'id',
                'joinColumn' =>  'session_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
        self::DESCRIPTION =>[
            'join' => [
                'relation' => 'user',
                'column' => 'description',
                'table' => 'sessions',
                'baseColumn' => 'id',
                'joinColumn' =>  'session_id',
                'baseTable' => 'financial_accounts'
            ]
        ],
    ];

 
}
