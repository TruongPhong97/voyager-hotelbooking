<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{   
    /**
     * Do not updated attribute
     */
    protected $guarded = ['order_items'];


    /**
     * Statuses
     */
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_PROCESSING = 'PROCESSING';
    public const STATUS_SUCCESSS = 'SUCCESSS';
    public const STATUS_CANCELED = 'CANCELED';

    /**
     * List of statuses.
     *
     * @var array
     */
    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_PROCESSING,
        self::STATUS_SUCCESSS,
        self::STATUS_CANCELED
    ];

    /**
     * Types
     */
    public const TYPE_BOOKING_ORDER = 'BOOKING_ORDER';
    public const TYPE_REFUND = 'REFUND';

    /**
     * List of Types.
     * 
     * @var array
     */
    public static $types = [
        self::TYPE_BOOKING_ORDER,
        self::TYPE_REFUND
    ];
}
