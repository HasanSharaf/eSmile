<?php


namespace Modules\Doctor\Models;


class EDoctorStatus
{
    public const ACTIVE = 'active';
    public const DEACTIVE = 'deactive';

    public const Doctor_ARR = [self::ACTIVE, self::DEACTIVE];
}
