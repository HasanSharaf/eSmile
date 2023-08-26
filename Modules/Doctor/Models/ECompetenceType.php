<?php


namespace Modules\Doctor\Models;


class ECompetenceType
{
    public const GENERAL_DENTISTRY = 'general_dentistry';
    public const ORTHODONTICS = 'orthodontics';
    public const PERIODONTOLOGY_AND_ORAL_SURGERY = 'periodontology_and_oral_surgery';
    public const COSMETIC_DENTISTRY = 'cosmetic_dentistry';
    public const CHILDRENS_DENTISTRY = 'childrens_dentistry';
    public const NEUROLOGY_IN_DENTISTRY = 'neurology_in_dentistry';

    public const COMPETENCE_ARR = [
    self::GENERAL_DENTISTRY, 
    self::ORTHODONTICS,
    self::PERIODONTOLOGY_AND_ORAL_SURGERY,
    self::COSMETIC_DENTISTRY,
    self::CHILDRENS_DENTISTRY,
    self::NEUROLOGY_IN_DENTISTRY
    ];
}
