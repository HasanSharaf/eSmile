<?php


namespace Modules\Appointment\Models;

class AppointmentSortKey
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
                'baseTable' => 'appointments'
            ]
        ],
        self::LAST_NAME => [
            'join' => [
                'relation' => 'user',
                'column' => 'last_name',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'appointments'
            ]
        ],
        self::EMAIL => [
            'join' => [
                'relation' => 'user',
                'column' => 'email',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'appointments'
            ]
        ],
        self::PHONE_NUMBER => [
            'join' => [
                'relation' => 'user',
                'column' => 'phone_number',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'appointments'
            ]
        ],
        self::LOCATION => [
            'join' => [
                'relation' => 'user',
                'column' => 'location',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'appointments'
            ]
        ],
        self::LOCATION_DETAILS => [
            'join' => [
                'relation' => 'user',
                'column' => 'location_details',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'appointments'
            ]
        ],
        self::GENDER => [
            'join' => [
                'relation' => 'user',
                'column' => 'gender',
                'table' => 'users',
                'baseColumn' => 'id',
                'joinColumn' =>  'user_id',
                'baseTable' => 'appointments'
            ]
        ],
        self::SELECTED_TIME =>[
            'column' => 'selected_time',
        ],
        self::NOTE =>[
            'column' => 'note',
        ],
    ];

 
}
