<?php


namespace Modules\User\Models;


class EUserStatus
{
    public const ACTIVE = 'active';
    public const DEACTIVE = 'deactive';

    public const USER_ARR = [self::ACTIVE, self::DEACTIVE];
}
