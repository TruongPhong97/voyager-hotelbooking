<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RoomCategory extends Model
{
    /**
     * Relationship with Room model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function rooms()
    {
        return $this->HasMany('App\Room');
    }
}
