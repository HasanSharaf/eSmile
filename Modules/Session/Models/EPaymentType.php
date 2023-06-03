<?php


namespace Modules\Session\Models;


class EPaymentType
{
    public const CASH = 'cash';
    public const CARD = 'card';

    public const PAYMENT_ARR = [self::CASH, self::CARD];
}
