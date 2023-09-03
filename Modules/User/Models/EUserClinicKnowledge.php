<?php


namespace Modules\User\Models;


class EUserClinicKnowledge
{
    public const SOCIAL_MEDIA = 'social_media';
    public const THROUGH_SOMEONE = 'through_someone';
    public const ROAD_SIGN = 'road_sign';
    public const RECOMMENDATION = 'recommendation';
    public const ETC = 'etc';

    public const KNOWLEDGE_ARR = [
    self::SOCIAL_MEDIA,
    self::THROUGH_SOMEONE, 
    self::ROAD_SIGN, 
    self::RECOMMENDATION, 
    self::ETC
    ];
}
