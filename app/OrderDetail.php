<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderDetail extends Model
{   
    /**
     * Payment status
     */
    public const STATUS_WAITING = 'WAITING';
    public const STATUS_PAID = 'PAID';
    public const STATUS_REFUNDED = 'REFUNDED';

    /**
     * List of payment statuses.
     *
     * @var array
     */
    public static $paymentStatuses = [
        self::STATUS_WAITING,
        self::STATUS_PAID,
        self::STATUS_REFUNDED,
    ];
}
