<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    public function room(){
        return $this->BelongsTo('App\Room');
    }
}
