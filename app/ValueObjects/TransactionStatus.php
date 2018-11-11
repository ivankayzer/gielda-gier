<?php
/**
 * Created by PhpStorm.
 * User: ivankayzer
 * Date: 11/11/2018
 * Time: 12:02
 */

namespace App\ValueObjects;


class TransactionStatus
{
    const PENDING = 1;

    const DECLINED = 2;

    const IN_PROGRESS = 3;

    const COMPLETED = 4;

    const CANCELED = 5;
}