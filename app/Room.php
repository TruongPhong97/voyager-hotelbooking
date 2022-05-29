<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
// use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;


class Room extends Model
{
    use Translatable;
    use Resizable;

    protected $translatable = ['title', 'seo_title', 'body', 'slug', 'meta_description', 'meta_keywords'];

    /**
     * Statuses.
     */
    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';

    /**
     * List of statuses.
     *
     * @var array
     */
    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    /**
     * Scope a query to only include active rooms.
     *
     * @param  $query  \Illuminate\Database\Eloquent\Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '=', static::STATUS_ACTIVE);
    }

    /**
     * Relationship with Service model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    /**
     * Relationship with Facility model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities()
    {
        return $this->belongsToMany('App\Facility');
    }

    /**
     * Relationship with Category model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\RoomCategory');
    }

    /**
     * Relationship with Booking model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function bookings()
    {
        return $this->HasMany('App\Booking', 'room_id', 'id');
    }
}
