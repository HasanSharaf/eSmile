<?php


namespace App\Models;


class EWeekDayType
{
    public const SATURDAY = 'saturday';
    public const SUNDAY = 'sunday';
    public const MONDAY = 'monday';
    public const TUESDAY = 'tuesday';
    public const WEDNESDAY = 'wednesday';
    public const THURSDAY = 'thursday';
    public const FRIDAY = 'friday';
   
    public const WEEKDAY_ARR = [
    self::SUNDAY,
    self::MONDAY, 
    self::TUESDAY, 
    self::WEDNESDAY, 
    self::THURSDAY, 
    self::FRIDAY, 
    self::SATURDAY
    ];

}